<?php

namespace App\Http\Livewire;

use App\Models\Cars;
use App\Models\Color;
use App\Models\OriginalStock;
use App\Models\RecieveStockOriginal;
use Livewire\Component;

class OriginalStockWorkerList extends Component
{
    public $search = '';
    public $original_stock_id=[];
    public $recent_weights=[];
    public $process=[];
    public $color_id=[];
    public $inputs = [];
    public function render()
    {
        $query = OriginalStock::query();
        $specificSearch = $this->search;
        $red_items=[];
        if(!empty($specificSearch)){
            $orderByExpression = "CASE WHEN shipment_number LIKE '%$specificSearch%' THEN 0 ELSE 1 END";
            $query->orderByRaw($orderByExpression);
            $red_items=OriginalStock::where('shipment_number','like','%'.$specificSearch.'%')->pluck('id')->toArray();
        }
        $items = $query->get();
        $processes = Cars::getProcesses();
        $colors = Color::latest()->pluck('name', 'id');
        return view('livewire.original-stock-worker-list', [
            'items' => $items,
            'processes' => $processes,
            'colors' => $colors,
            'red_items'=>$red_items
        ]);
    }
    public function insert()
    {
        dd($this->inputs);
        // RecieveStockOriginal::create([
            // 'name' => $this->name,
            // 'description' => $this->description,
        // ]);

        // $this->reset(['name', 'description']);
    }
}
