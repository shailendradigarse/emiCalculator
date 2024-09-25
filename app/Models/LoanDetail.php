<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    use HasFactory;

    // Define the table name if it does not follow Laravel's convention
    protected $table = 'loan_details';

    // Specify which fields are mass assignable
    protected $fillable = [
        'clientid',
        'num_of_payment',
        'first_payment_date',
        'last_payment_date',
        'loan_amount',
    ];

    // Optionally, disable timestamps if your table does not have created_at and updated_at columns
    public $timestamps = true;  // Set to false if you don't have these fields

    // Define date fields as Carbon instances for easier manipulation
    protected $dates = [
        'first_payment_date',
        'last_payment_date',
    ];

    // You can add any custom functions here, such as calculating EMI or other loan-related details
    public function calculateEMI()
    {
        if ($this->num_of_payment > 0) {
            return $this->loan_amount / $this->num_of_payment;
        }

        return 0;
    }
}
