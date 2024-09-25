<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\EmiServiceInterface;

class EMIController extends Controller
{
    protected $emiService;

    public function __construct(EmiServiceInterface $emiService)
    {
        $this->emiService = $emiService;
    }

    public function process(Request $request)
    {
        $emiData = $this->emiService->processEmiData();

        return redirect()->back()->with($emiData);
    }

}
