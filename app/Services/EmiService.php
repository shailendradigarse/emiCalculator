<?php

// app/Services/EmiService.php
namespace App\Services;

use App\Repositories\LoanDetailRepositoryInterface;
use Carbon\Carbon;

class EmiService implements EmiServiceInterface
{
    protected $loanDetailRepository;

    public function __construct(LoanDetailRepositoryInterface $loanDetailRepository)
    {
        $this->loanDetailRepository = $loanDetailRepository;
    }

    public function processEmiData()
    {
        $loanDetails = $this->loanDetailRepository->getAllLoanDetails();
        $minDate = $this->loanDetailRepository->getMinFirstPaymentDate();
        $maxDate = $this->loanDetailRepository->getMaxLastPaymentDate();

        $startDate = Carbon::parse($minDate);
        $endDate = Carbon::parse($maxDate);

        // Create dynamic columns based on months
        $columns = [];
        while ($startDate->lte($endDate)) {
            $columns[] = $startDate->format('Y_F');
            $startDate->addMonth();
        }

        $emiDetails = [];

        // Process EMI data for each loan
        foreach ($loanDetails as $loan) {
            $emi = $loan->loan_amount / $loan->num_of_payment;
            $rowData = ['clientid' => $loan->clientid];

            $paymentStart = Carbon::parse($loan->first_payment_date)->startOfMonth();
            $paymentEnd = Carbon::parse($loan->last_payment_date)->endOfMonth();

            $currentDate = Carbon::parse($minDate)->startOfMonth();
            $emiCount = 0;

            foreach ($columns as $column) {
                if ($currentDate->between($paymentStart, $paymentEnd) && $emiCount < $loan->num_of_payment) {
                    $rowData[$column] = number_format($emi, 2, '.', '');
                    $emiCount++;
                } else {
                    $rowData[$column] = '0.00';
                }
                $currentDate->addMonth();
            }

            // Adjust the last EMI to ensure total equals loan amount
            $totalEmi = array_sum(array_slice($rowData, 1)); // Skip clientid
            if ($totalEmi != $loan->loan_amount) {
                $lastMonth = $paymentEnd->format('Y_F');
                $rowData[$lastMonth] = number_format($loan->loan_amount - ($totalEmi - $rowData[$lastMonth]), 2, '.', '');
            }

            $emiDetails[] = $rowData;
        }

        return [
            'emiDetails' => $emiDetails,
            'emiColumns' => $columns
        ];
    }
}
