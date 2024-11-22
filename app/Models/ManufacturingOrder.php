<?php

namespace Modules\Manufacturing\Entities;

use App\Models\Product\Product;
use App\Models\Product\ProductVariation;
use App\Models\Product\UOM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Manufacturing\Database\factories\ManufacturingOrderFactory;

class ManufacturingOrder extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'order_no',
        'business_location_id',
        'product_id',
        'variation_id',
        'uom_id',
        'quantity',
        'created_by',
        'updated_by',
        'is_delete',
        'deleted_by'
    ];

    public function processes()
    {
        return $this->hasMany(ManufacturingProcess::class);
    }

    public function business_location(){
        return $this->belongsTo(\App\Models\settings\businessLocation::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function product_variation(): HasOne
    {
        return $this->hasOne(ProductVariation::class, 'id', 'variation_id');
    }

    public function uom() : BelongsTo
    {
        return $this->belongsTo(UOM::class);
    }

}
