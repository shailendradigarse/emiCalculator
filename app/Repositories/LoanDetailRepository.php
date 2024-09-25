<?php
// app/Repositories/LoanDetailRepository.php
namespace App\Repositories;

use App\Models\LoanDetail;
use Carbon\Carbon;

class LoanDetailRepository implements LoanDetailRepositoryInterface
{
    public function getAllLoanDetails()
    {
        return LoanDetail::all();
    }

    public function getMinFirstPaymentDate()
    {
        return LoanDetail::min('first_payment_date');
    }

    public function getMaxLastPaymentDate()
    {
        return LoanDetail::max('last_payment_date');
    }
}
