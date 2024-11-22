<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ReceipeOfMaterialDetail;

class RomTr extends Component
{
    public $rom;
    public $romDetails = null;
    public $hello="";

    // public function hello(){
    //     dd('why hello is here');
    // }
    public function fetchDetail($id) {
        $romDetails = ReceipeOfMaterialDetail::where('receipe_of_material_id', $id)
        ->with('productVariation.product')
        ->get()
        ->toArray();
        if (isset($this->romDetails[$id])) {
            unset($this->romDetails[$id]);
        } else {
            $this->romDetails[$id] = $romDetails;
        }
    }
    public function updatedHello(){
        dd('here');
    }
    public function render()
    {
        return view('livewire.rom-tr');
    }
}
