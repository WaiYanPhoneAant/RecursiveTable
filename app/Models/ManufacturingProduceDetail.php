<?php

namespace Modules\Manufacturing\Entities;

use App\Models\Product\Product;
use App\Models\Product\ProductVariation;
use App\Models\Product\UOM;
use App\Models\Product\VariationTemplateValues;
use App\Models\Product\VariationValue;
use App\Models\productPackaging;
use App\Models\productPackagingTransactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Manufacturing\Database\factories\ManufacturingProduceDetailFactory;

class ManufacturingProduceDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'manufacturing_id',
        'parent_id',
        'product_id',
        'variation_id',
        'uom_id',
        'received_quantity',
        'quantity',
        'cost',
        'created_by',
        'updated_by',
        'is_delete',
        'deleted_by'

    ];

    public function manufacture_process()
    {
        return $this->belongsTo(ManufacturingProcess::class, 'manufacturing_id');
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


    public function packagingTx() {
        return $this->hasOne(productPackagingTransactions::class, 'transaction_details_id', 'id')
            ->where('transaction_type','manufacturing');
    }

    public function product_packaging(): HasOne
    {
        return $this->hasOne(productPackaging::class, 'product_id', 'id');
    }

    public function variation_values() : HasMany
    {
        return $this->hasMany(VariationValue::class, 'product_variation_id', 'variation_id');
    }

//    public function product(): HasOne
//    {
//        return $this->hasOne(Product::class, 'id', 'product_id');
//    }
    public function productVariation()
    {
        return $this->hasOne(ProductVariation::class,'id','variation_id');
    }
    public function purchaseUom(): HasOne
    {
        return $this->hasOne(UOM::class, 'id', 'uom_id');
    }

}
