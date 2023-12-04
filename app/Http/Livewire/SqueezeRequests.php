<?php

namespace App\Http\Livewire;

use App\Models\Cars;
use App\Models\Employee;
use App\Models\FillPressRequest;
use App\Models\PressingRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SqueezeRequests extends Component
{
    public $search='';
    public $weight=0;
    public $total_weight=0;
    public $quantity=0;
    // public $bale_id=0;
    public $rows = [];
    public $car = [];
    public $pressingrequestid =null;
    public $class=[];
    public function render()
    {   $weight=$this->weight;
        $quantity=$this->quantity;
        // $this->car=Cars::where('sku',$this->search)->where('weight_product','!=','0')->where('next_process','squeeze')->first();

        // $this->total_weight=!empty($this->car)?$this->car['weight_product']:0;
        return view('livewire.squeeze-requests',compact('weight','quantity'));
    }
    public function addCar(){
        $this->car=Cars::where('sku',$this->search)->where('weight_product','!=','0')->where('next_process','squeeze')->first();

        $this->total_weight=!empty($this->car)?$this->car['weight_product']:0;
        if(empty($this->car)){
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.There_is_no_car_with_this_code')]);
        }

    }
    public function press_bale($index,$total_weight){
        try{
            if($this->rows[$index]['bale_weight']==null){
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.enter_bale_weight')]);
            }else{
                $fillPressRequest=FillPressRequest::create([
                    'press_request_id'=>$this->pressingrequestid,
                    'employee_id'=>Employee::find(Auth::user()->id)->id,
                    'sku'=>"123456",
                    'weight'=>$this->rows[$index]['bale_weight'],
                    'cars_id'=>$this->car['id']
                ]);

                $this->class[$index]="text-black";
                $this->rows[$index]['bale_id']=$fillPressRequest->id;
                Cars::find($this->car['id'])->update([
                    'process'=>'squeeze',
                    'employee_id'=>Employee::find(Auth::user()->id)->id,
                    // 'next_process'=>'',
                    'weight_product'=>Cars::find($this->car['id'])->weight_product-$this->rows[$index]['bale_weight'],
                ]);
                if(FillPressRequest::where('press_request_id',$this->pressingrequestid)->count()==$this->quantity){
                    // PressingRequest::find($this->pressingrequestid)->update(['status'=>'1']);
                }
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success')]);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
}
