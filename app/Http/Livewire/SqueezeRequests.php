<?php

namespace App\Http\Livewire;

use App\Models\Cars;
use App\Models\Employee;
use App\Models\FillPressRequest;
use App\Models\PressingRequest;
use App\Models\System;
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
    // ++++++++++++ packing_tape ++++++++++++
    public $packing_tape_rest = 0;
    public $packing_tape_required = 0;
    // ++++++++++++++ mount() ++++++++++++++
    public function mount()
    {
        // Retrieve the 'packing_tape' value from the System model and set it to $packing_tape_rest
        $this->packing_tape_rest = System::getProperty('packing_tape');
    }
    // ++++++++++++++ updatedPackingTapeRequired ++++++++++++++
    public function changePackingTapeRequired()
    {
        // Update packing_tape_rest when packing_tape_required is updated
        $this->packing_tape_rest -= $this->packing_tape_required;
        // // Save the updated packing_tape_rest value to the 'packing_tape' key in the System model
        // System::where('key', 'packing_tape')->update(['value' => $this->packing_tape_rest]);
    }

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
    // +++++++++++++++++ press_bale() +++++++++++++++++
    public function press_bale($index,$total_weight)
    {
        try
        {
            if($this->rows[$index]['bale_weight']==null)
            {
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.enter_bale_weight')]);
            }
            else
            {
                // ++++++++++ Save the updated packing_tape_rest value to the 'packing_tape' key in the System model ++++++++++
                System::where('key', 'packing_tape')->update(['value' => $this->packing_tape_rest]);

                $fillPressRequest=FillPressRequest::create([
                    'press_request_id'=>$this->pressingrequestid,
                    'employee_id'=>Employee::find(Auth::user()->id)->id,
                    'sku'=>"123456",
                    'weight'=>$this->rows[$index]['bale_weight'],
                    'cars_id'=>$this->car['id'],
                    'packing_tape_required' => $this->packing_tape_required,
                    'packing_tape_rest' => $this->packing_tape_rest,
                ]);
                $pressing_request=PressingRequest::find($this->pressingrequestid);
                $pressing_request->update([
                    'quantity'=>((int)$pressing_request->quantity) - 1,
                    'status'=>(((int)$pressing_request->quantity) - 1)>0?0:'complete',
                ]);

                $this->class[$index]="text-black";
                $this->rows[$index]['bale_id']=$fillPressRequest->id;
                Cars::find($this->car['id'])->update([
                    'process'=>'squeeze',
                    'employee_id'=>Employee::find(Auth::user()->id)->id,
                    // 'next_process'=>'',
                    'weight_product'=>Cars::find($this->car['id'])->weight_product-$this->rows[$index]['bale_weight'],
                ]);
                // if(FillPressRequest::where('press_request_id',$this->pressingrequestid)->count()==$this->quantity){
                //     // PressingRequest::find($this->pressingrequestid)->update(['status'=>'1']);
                // }
                // $this->addCar();
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success')]);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
}
