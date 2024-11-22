<?php

namespace Modules\Manufacturing\Entities;

use App\Models\lotSerialDetails;
use App\Models\Product\UOM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Manufacturing\Database\factories\ManufacturingUsageDetailFactory;

class ManufacturingUsageDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'manufacturing_id',
        'product_id',
        'variation_id',
        'uom_id',
        'quantity',
        'cost',
        'created_by',
        'updated_by',
        'is_delete',
        'deleted_by'
    ];

    public function uom() : BelongsTo
    {
        return $this->belongsTo(UOM::class);
    }

    public function lot_serial_details(): HasMany
    {
        return $this->hasMany(LotSerialDetails::class, 'transaction_detail_id', 'id')
            ->where('transaction_type', 'manufacture');
    }


}
