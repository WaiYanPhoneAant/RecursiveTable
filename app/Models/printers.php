<?php

namespace App\Models;

use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class printers extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'name',
        'printer_type',
        'ip_address',
        'default_printer',
        'port',
        'product_category_id',
        'printer_ip_address',
        'printer_port',
        'print_server_type'
    ];
    public function category(){
        return $this->hasOne(Category::class,'id','product_category_id');
    }
}
