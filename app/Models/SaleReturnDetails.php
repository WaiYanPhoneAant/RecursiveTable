<?php

namespace App\Models;

use sale;
use App\Models\sale\sales;
use App\Models\Product\UOM;
use App\Models\Product\Product;
use App\Models\sale\sale_details;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleReturnDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_return_id', 'product_id', 'variation_id', 'transaction_type',
        'sale_detail_id', 'sales_id', 'uom_id', 'quantity', 'uom_return_price',
        'subtotal', 'created_by', 'created_at', 'updated_at',
        'is_delete',
        'deleted_by',
        'deleted_at',
    ];

    // Relationships
    public function saleReturn()
    {
        return $this->belongsTo(SaleReturn::class, 'id', 'sale_return_id');
    }
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function transaction_detail(){
        return $this->hasOne(sale_details::class, 'id', 'sale_detail_id');
    }

    public function sales(){
        return $this->belongsTo(sales::class, 'id', 'sales_id');
    }

    public function uom(): HasOne
    {
        return $this->hasOne(UOM::class, 'id', 'uom_id');
    }
    public function packagingTx()
    {
        return $this->hasOne(productPackagingTransactions::class, 'transaction_details_id', 'transaction_detail_id')
            ->where('transaction_type', 'sale');
    }

    public function product_packaging(): HasMany
    {
        return $this->hasMany(productPackaging::class, 'product_id', 'product_id');
    }
}
