<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EMIController extends Controller
{
    public function process(Request $request)
    {
        $loanDetails = LoanDetail::all();
        $minDate = LoanDetail::min('first_payment_date');
        $maxDate = LoanDetail::max('last_payment_date');

        $startDate = Carbon::parse($minDate);
        $endDate = Carbon::parse($maxDate);

        // Create dynamic columns based on months
        $columns = [];
        while ($startDate->lte($endDate)) {
            $columns[] = $startDate->format('Y_F'); // E.g., 2019_Feb
            $startDate->addMonth();
        }

        $emiDetails = [];

        // Process EMI data for each loan
        foreach ($loanDetails as $loan) {
            $emi = $loan->loan_amount / $loan->num_of_payment;
            $rowData = ['clientid' => $loan->clientid];

            // Start from the first payment month (ensure it starts from June 2018 for client 1001)
            $paymentStart = Carbon::parse($loan->first_payment_date)->startOfMonth();
            $paymentEnd = Carbon::parse($loan->last_payment_date)->endOfMonth();

            // Loop through all columns (months), apply EMI where applicable
            $currentDate = Carbon::parse($minDate)->startOfMonth(); // Start from the minimum date's month
            $emiCount = 0;

            foreach ($columns as $column) {
                if ($currentDate->between($paymentStart, $paymentEnd) && $emiCount < $loan->num_of_payment) {
                    // Apply EMI only if within payment period and less than the number of payments
                    $rowData[$column] = number_format($emi, 2, '.', '');
                    $emiCount++; // Count EMI payments applied
                } else {
                    $rowData[$column] = '0.00'; // If not in the payment period, set to 0.00
                }
                $currentDate->addMonth(); // Move to the next month
            }

            // Adjust the last EMI to ensure total equals loan amount
            $totalEmi = array_sum(array_slice($rowData, 1)); // Skip clientid
            if ($totalEmi != $loan->loan_amount) {
                $lastMonth = $paymentEnd->format('Y_F');
                $rowData[$lastMonth] = number_format($loan->loan_amount - ($totalEmi - $rowData[$lastMonth]), 2, '.', '');
            }

            $emiDetails[] = $rowData;
        }

        // Pass data to session to display on the page
        return redirect()->back()->with([
            'emiDetails' => $emiDetails,
            'emiColumns' => $columns
        ]);
    }

}
