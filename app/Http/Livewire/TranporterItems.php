<?php

namespace App\Http\Livewire;

use App\Models\Cars;
use Livewire\Component;

class TranporterItems extends Component
{
    public $search='';
    public function render()
    {
        $cars=Cars::where('sku', 'like', '%' . $this->search . '%')->latest()->get();
        return view('livewire.tranporter-items',compact('cars'));
    }
}
