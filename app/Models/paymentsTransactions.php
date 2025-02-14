<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentsTransactions extends Model
{
    use HasFactory;
public $timestamps=false;
    public $fillable=[
        'id',
        'business_id',
        'payment_voucher_no',
        'payment_date',
        'transaction_type',
        'exchange_rate',
        'transaction_id',
        'transaction_ref_no',
        'payment_method',
        'payment_account_id',
        'payment_type',
        'payment_amount',
        'currency_id',
        'note',
        'is_change'
    ];
    public function currency(){
        return $this->hasOne(Currencies::class,'id','currency_id');
    }
    public function payment_account(){
        return $this->hasOne(paymentAccounts::class,'id','payment_account_id');
    }
}
