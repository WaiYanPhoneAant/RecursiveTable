<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactDocumentRecords extends Model
{
    use HasFactory;
    public $fillable=[
        'contact_id',
        'title',
        'document',
        'note'
    ];
}
