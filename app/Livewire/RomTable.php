<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ReceipeOfMaterial;
use App\Models\ReceipeOfMaterialDetail;

class RomTable extends Component
{

    public $productId = 'all';

    public function render()
    {
        $productId = $this->productId;
        $roms=$productId == 'all' ?
        ReceipeOfMaterial::with('product')->get() : ReceipeOfMaterial::with('product')
            ->when($productId !=null && $productId!='all',function($query)use($productId){
                return $query->where('product_id',$productId);
            })->get();
        return view('livewire.rom-table',compact('roms'));
    }
}
