<?php

namespace App\Models\Product;

use App\Models\locationProduct;
use App\Models\Product\UOM;
use App\Models\productPackaging;
use App\Models\CurrentStockBalance;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\ProductVariation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ReceipeOfMaterial;
use App\Models\Product\ProductVariationsTemplates;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'product_code',
        'sku',
        'product_type',
        'has_variation',
        'brand_id',
        'category_id',
        'sub_category_id',
        'manufacturer_id',
        'generic_id',
        'lot_count',
        'uom_id',
        'purchase_uom_id',
        'can_sale',
        'can_purchase',
        'can_expense',
        'can_expense',
        'is_recurring',
        'receipe_of_material_id',
        'product_custom_field1',
        'product_custom_field2',
        'product_custom_field3',
        'product_custom_field4',
        'image',
        'images',
        'product_description',
        'details_json',
        'is_inactive',
        'created_by',
        'updated_by',
        'deleted_by',


    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'details_json' => 'array',
    ];



    protected static function booted()
    {
        parent::boot();

//        static::created(function ($model) {
////            $model->details_json = json_encode([
////                'variation_name' => $model->id,
////                'brand_name' => $model->brand->name ?? null,
////                'category_name' => $model->category->name ?? null,
////                'sub_category_name' => $model->subCategory->name ?? null,
////                'manufacturer_name' => $model->manufacturer->name ?? null,
////                'generic_name' => $model->generic->name ?? null,
////                'uom_name' => $model->uom->name ?? null,
////                'purchase_uom_name' => $model->purchaseUom->name ?? null,
////            ]);
//        });
//
//
//        static::updating(function ($model) {
//            $existingDetails = json_decode($model->details_json, true) ?? [];
//
//            $newDetails = [
//                'brand_name' => $model->brand->name ?? $existingDetails['brand_name'] ?? null,
//                'category_name' => $model->category->name ?? $existingDetails['category_name'] ?? null,
//                'sub_category_name' => $model->subCategory->name ?? $existingDetails['sub_category_name'] ?? null,
//                'manufacturer_name' => $model->manufacturer->name ?? $existingDetails['manufacturer_name'] ?? null,
//                'generic_name' => $model->generic->name ?? $existingDetails['generic_name'] ?? null,
//                'uom_name' => $model->uom->name ?? $existingDetails['uom_name'] ?? null,
//                'purchase_uom_name' => $model->purchaseUom->name ?? $existingDetails['purchase_uom_name'] ?? null,
//            ];
//
//            $model->details_json = json_encode($newDetails);
//        });

    }


    public function productVariations(): HasMany
    {
        return $this->hasMany(ProductVariation::class,'product_id','id');
    }

    public function productVariationTemplates(): HasMany
    {
        return $this->hasMany(ProductVariationsTemplates::class);
    }
    public function product_variations(): HasOne
    {
        return $this->hasOne(ProductVariation::class, 'product_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function generic(): BelongsTo
    {
        return $this->belongsTo(Generic::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function uom(): BelongsTo
    {
        return $this->belongsTo(UOM::class);
    }
    public function purchaseUOM(): BelongsTo
    {
        return $this->belongsTo(UOM::class, 'purchase_uom_id', 'id');
    }

    public function stock()
    {
        return $this->hasMany(CurrentStockBalance::class);
    }
    public function variationTemplateValue(): BelongsTo
    {
        return $this->belongsTo(VariationTemplateValues::class, 'variation_template_value_id', 'id');
    }


    public function varPackaging(): HasOne
    {
        return $this->hasOne(productPackaging::class, 'product_variation_id', 'product_variations.id');
    }
    public function variation_values(): HasMany
    {
        return $this->hasMany(VariationValue::class, 'product_variation_id', 'variation_id');
    }
    public function product_packaging(): HasOne
    {
        return $this->hasOne(productPackaging::class, 'product_id', 'id');
    }

    public function packaging(): HasMany
    {
        return $this->hasMany(productPackaging::class, 'product_id', 'id');
    }

    public function rom(): HasOne
    {
        return $this->hasOne(ReceipeOfMaterial::class, 'id', 'receipe_of_material_id');
    }

    public function product_variation(): HasOne
    {
        return $this->hasOne(ProductVariation::class, 'product_id', 'id');
    }

    public function product_variation_templates(): HasMany
    {
        return $this->hasMany(ProductVariationsTemplates::class);
    }

    public function locations_product(): HasMany
    {
        return $this->hasMany(locationProduct::class);
    }

    public function CategoryProduct(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }
}
