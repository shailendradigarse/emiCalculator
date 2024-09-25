<?php
// app/Repositories/LoanDetailRepositoryInterface.php
namespace App\Repositories;

interface LoanDetailRepositoryInterface
{
    public function getAllLoanDetails();
    public function getMinFirstPaymentDate();
    public function getMaxLastPaymentDate();
}
