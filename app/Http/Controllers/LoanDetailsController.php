<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanDetail;

class LoanDetailsController extends Controller
{
    public function index()
    {
        $loanDetails = LoanDetail::all();
        return view('loan_details.index', compact('loanDetails'));
    }

}
