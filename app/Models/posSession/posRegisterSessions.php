<?php

namespace App\Models\posSession;

use App\Models\posRegisters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posRegisterSessions extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'pos_register_id',
        'status',
        'opening_amount',
        'opening_at',
        'closing_amount',
        'closing_at',
        'closing_note',
    ];
    public function posRegister(){
        return $this->hasOne(posRegisters::class,'id','pos_register_id');
    }
}
