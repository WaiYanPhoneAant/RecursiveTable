<?php

namespace App\Models\Contact;

use App\Models\ContactPriceList;
use App\Models\Product\PriceLists;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Wallet\Entities\WalletOwner;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table= 'contacts';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'business_id',
        'type',
        'contact_id',
        'price_list_id',
        'company_name',
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'gender',
        'age',
        'is_active',
        'tax_number',
        'township',
        'city',
        'state',
        'country',
        'address_line_1',
        'address_line_2',
        'zip_code',
        'dob',
        'mobile',
        'landline',
        'alternate_number',
        'pay_term_value',
        'pay_term_type',
        'credit_limit',
        'receivable_amount',
        'payable_amount',
        'is_default',
        'shipping_address',
        'customer_group_id',
        'custom_field_1',
        'custom_field_2',
        'custom_field_3',
        'custom_field_4',
        'custom_field_5',
        'custom_field_6',
        'custom_field_7',
        'custom_field_8',
        'custom_field_9',
        'custom_field_10',
        'created_by',
        'updated_by',
        'is_delete',
        'deleted_at',
        'opening_receivable_amount',
        'opening_payable_amount',
        'identification_no',
        'nrc_code',
        'nrc_type',
        'nrc_place',
        'nrc_number'
    ];

    public function getFullNameAttribute()
    {
        $name_array = [];
        if (!empty($this->prefix)) {
            $name_array[] = $this->prefix;
        }
        if (!empty($this->first_name)) {
            $name_array[] = $this->first_name;
        }
        if (!empty($this->middle_name)) {
            $name_array[] = $this->middle_name;
        }
        if (!empty($this->last_name)) {
            $name_array[] = $this->last_name;
        }
        return implode(' ', $name_array);
    }

    public function getAddressAttribute(){
        $address_array = [];

        if(!empty($this->address_line_1)){
            $address_array[] = $this->address_line_1;
        }

        if(!empty($this->address_line_2)){
            $address_array[] = $this->address_line_2;
        }

        if(!empty($this->city)){
            $address_array[] = $this->city;
        }

        if(!empty($this->state)){
            $address_array[] = $this->state;
        }

        if(!empty($this->country)){
            $address_array[] = $this->country;
        }

        if(!empty($this->zip_code)){
            $address_array[] = $this->zip_code;
        }

        return implode(', ', $address_array);
    }

    public function getPayTerm(){
        $payTerm = [];

        if(!empty($this->pay_term_value)){
            $payTerm[] = $this->pay_term_value;
        }

        if(!empty($this->pay_term_type)){
            $payTerm[] = $this->pay_term_type;
        }

        return implode(' ', $payTerm);
    }

    public function reservations() {
        return $this->hasMany(\App\Models\Reservation\Reservation::class);
    }

    public function pricelist()
    {
        return $this->belongsTo(PriceLists::class, 'price_list_id');
    }

    public function contactPriceLists()
    {
        return $this->belongsToMany(PriceLists::class, 'contact_price_lists', 'contact_id', 'price_list_id');
    }

    public function wallet_owner()
    {
        return $this->morphOne(WalletOwner::class, 'user');
    }

}
