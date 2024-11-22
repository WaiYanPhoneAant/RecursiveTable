<?php

namespace App\Models;

use App\Models\Contact\Contact;
use Illuminate\Database\Eloquent\Model;
use App\Models\settings\businessLocation;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleReturn extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_return_voucher_no',
        'business_location_id',
        'contact_id',
        'sale_return_date',
        'sale_return_person',
        'total_return_amount',
        'paid_amount',
        'balance_amount',
        'status',
        'note',
        'created_by',
        'created_at',
        'updated_at',
        'is_delete',
        'deleted_by',
        'deleted_at',
    ];

    public function details()
    {
        return $this->hasMany(SaleReturnDetails::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function business_location_id()
    {
        return $this->belongsTo(businessLocation::class, 'business_location_id', 'id');
    }
    public function returnPerson(): HasOne
    {
        return $this->hasOne(BusinessUser::class, 'id', 'sale_return_person');
    }
    public function created_by(): HasOne
    {
        return $this->hasOne(BusinessUser::class, 'id', 'created_by');
    }
    public function currency()
    {
        return $this->hasOne(Currencies::class, 'id', 'currency_id');
    }

}