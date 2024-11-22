<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPriceList extends Model
{
    use HasFactory;

    protected $table = 'contact_price_list';
    protected $fillable = [
        'contact_id',
        'price_list_id',
    ];
}
