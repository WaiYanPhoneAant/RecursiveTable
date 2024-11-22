<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $fillable = [
            'key', 'data', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
