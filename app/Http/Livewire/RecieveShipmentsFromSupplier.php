<?php

namespace App\Http\Livewire;

use App\Models\Cars;
use App\Models\Color;
use App\Models\OriginalStock;
use Livewire\Component;

class RecieveShipmentsFromSupplier extends Component
{

    public $search = '';
    public $rows = [];
    // public $id = '';
    public function index($i)
    {
        $actualweight = 0;
        $wetweight = 0;
        $dryweight = 0;
        if (!empty($this->rows[$i]['actualweight'])) {
            $actualweight = $this->rows[$i]['actualweight'];
        }
        if (!empty($this->rows[$i]['wetweight'])) {
            $wetweight = $this->rows[$i]['wetweight'];
        }
        if (!empty($this->rows[$i]['dryweight'])) {
            $dryweight = $this->rows[$i]['dryweight'];
        }
        $this->rows[$i]['totalweight'] = $actualweight - ($wetweight - $dryweight);
        $this->rows[$i]['diffwetdry'] = $wetweight - $dryweight;
        // if(!empty($this->rows[$i]['id'])){
        // $id=$this->rows[$i]['id'];
        // }
        // $this->rows[$i]['id']=$i;
    }
    public function insertSelectedData()
    {
        try {
            foreach ($this->rows as $index => $row) {
                OriginalStock::find($index)->update([
                    'actual_weight' => isset($row['actualweight']) ? $row['actualweight'] : 0,
                    'wet_weight' => isset($row['wetweight']) ? $row['wetweight'] : 0,
                    'dry_weight' => isset($row['dryweight']) ? $row['dryweight'] : 0,
                    'total_weight' => isset($row['totalweight']) ? $row['totalweight'] : 0,
                    'status'=>'recieved'
                ]);
            }
            $this->rows = [];
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success'),]);
            return redirect()->back();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
    public function saveLaterSelectedData()
    {
        try {
            foreach ($this->rows as $index => $row) {
                OriginalStock::find($index)->update([
                    'actual_weight' => isset($row['actualweight']) ? $row['actualweight'] : 0,
                    'wet_weight' => isset($row['wetweight']) ? $row['wetweight'] : 0,
                    'dry_weight' => isset($row['dryweight']) ? $row['dryweight'] : 0,
                    'total_weight' => isset($row['totalweight']) ? $row['totalweight'] : 0,
                    'status'=>'save_later',
                ]);
            }
            $this->rows = [];
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success'),]);
            return redirect()->back();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
    public function cancelSelectedData(){
        $this->rows = [];
    }
    public function render()
    {
        $query = OriginalStock::query();
        $specificSearch = $this->search;
        $red_items = [];
        if (!empty($specificSearch)) {
            $orderByExpression = "CASE WHEN sku LIKE '%$specificSearch%' THEN 0 ELSE 1 END";
            $query->orderByRaw($orderByExpression);
            $red_items = OriginalStock::where('sku', 'like', '%' . $specificSearch . '%')->pluck('id')->toArray();
        }
        $items = $query->whereIn('status',['pending','save_later'])->latest()->paginate(10);
        $processes = Cars::getProcesses();
        $colors = Color::latest()->pluck('name', 'id');
        return view('livewire.recieve-shipments-from-supplier', [
            'items' => $items,
            'processes' => $processes,
            'colors' => $colors,
            'red_items' => $red_items
        ]);
    }
}
