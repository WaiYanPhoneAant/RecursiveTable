<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentTransactionsSummary extends Model
{
    use HasFactory;
    public $table="payment_transactions_summary";
    protected $fillable = [
        'business_id',
        'description',
        'payment_summary_voucher_no',
        'payment_date',
        'paid_by',
        'transaction_type',
        'transaction_id',
        'transaction_ref_no',
        'payment_method',
        'payment_account_id',
        'payment_type',
        'payment_amount',
        'exchange_rate',
        'currency_id',
        'note'
    ];

}
