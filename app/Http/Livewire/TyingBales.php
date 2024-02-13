<?php

namespace App\Http\Livewire;

use App\Models\FillPressRequest;
use App\Models\TyingBale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TyingBales extends Component
{
    public $search='';
    public $full_weight=0;
    public $bales=array();
    public $object=array();
    public $tie_id='';
    public function render()
    {
        return view('livewire.tying-bales');
    }

    public function addBale(){
        $bale=FillPressRequest::where('sku',$this->search)->first();
        if (count($this->object)==0 || count($this->object) % 4 !== 0)
        {
            if(isset($bale->sku) && !empty($bale))
            {
                    array_push($this->object,$bale->sku);
                    array_push($this->bales,$bale->id);
                    $this->full_weight+=$bale->weight;
            }
        }
    }
    public function cancelBale($index){
        unset($this->object[$index]);
        unset($this->bales[$index]);
        $this->object=array_values($this->object);
        $this->bales=array_values($this->bales);
    }
    public function saveTie(){
        try{
            $tie=TyingBale::updateOrCreate(['id'=>$this->tie_id],[
                'fill_press_request_id1'=>$this->bales[0],
                'fill_press_request_id2'=>$this->bales[1],
                'fill_press_request_id3'=>$this->bales[2],
                'fill_press_request_id4'=>$this->bales[3],
                'full_weight'=>$this->full_weight,
                'created_by'=>Auth::user()->id
            ]);
            if(!empty($tie)){
                $this->tie_id=$tie->id;
            }
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success')]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
}
