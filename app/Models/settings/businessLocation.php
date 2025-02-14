<?php

namespace App\Models\settings;

use App\Models\locationAddress;
use App\Models\locationProduct;
use App\Models\locationType;
use App\Models\Product\PriceLists;
use App\Models\Stock\Stockin;
use App\Models\Stock\StockTransfer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class businessLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'location_code',
        'name',
        'is_active',
        'allow_purchase_order',
        'allow_sale_order',
        'price_lists_id',
        'parent_location_id',
        'location_type',
        'inventory_flow',
        'invoice_layout',
        'gps_location',
        'allow_pickup_order',
        'outlet_type',
    ];

    // protected $casts = [
    //     'featured_products' => 'array',
    // ];

    protected $dates = ['deleted_at'];

    public function scopeAllowedPickup($query)
    {
        return $query->where('allow_pickup_order', 1);
    }

    public function parentLocation()
    {
        return $this->hasOne(businessLocation::class,'id', 'parent_location_id');
    }
    public function locationAddress()
    {
        return $this->belongsTo(locationAddress::class, 'id', 'location_id');
    }
    public function locationType()
    {
        return $this->hasOne(locationType::class, 'id', 'location_type');
    }
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    public function stockins()
    {
        return $this->hasMany(Stockin::class);
    }

    public function stocktransfers()
    {
        return $this->hasMany(StockTransfer::class);
    }

    public function pricelist()
    {
        return $this->belongsTo(PriceLists::class, 'price_lists_id');
    }
    public function products(){
        return $this->morphToMany(locationProduct::class,'id','location_id');
    }
}
