<?php

namespace App\Http\Livewire;

use App\Models\CarExtra;
use App\Models\Cars;
use Livewire\Component;

class TranporterItems extends Component
{
    public $search='';
    public $row_background_color='';
    public function render()
    {
        $cars=Cars::where('sku', 'like', '%' . $this->search . '%')->latest()->get();
        return view('livewire.tranporter-items',compact('cars'));
    }
    public function move($id){
        try{
        $car=Cars::find($id);
        $car->update([
            'process'=>$car->next_process,
            'recent_place'=>$car->next_place,
            'next_process'=>null,
            'next_place'=>null,
            'used_cart'=>'not_used'
        ]);
        $car_next_employees=CarExtra::where('cars_id',$id)->whereNotNull('next_employee_id')->pluck('next_employee_id');
        CarExtra::where('cars_id',$id)->whereNotNull('employee_id')->delete();
        
        for ($i = 0; $i < count($car_next_employees); $i++) {
            CarExtra::create([
                'cars_id' => $car->id,
                'employee_id' => $car_next_employees[$i]
            ]);
        }
        CarExtra::where('cars_id',$id)->whereNotNull('next_employee_id')->delete();
        $this->row_background_color='table-danger';
        $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success'),]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
    public function useCar($id){
        try{
            Cars::find($id)->update([
                'used_cart'=>'used'
            ]);
            $this->row_background_color='table-success';
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success'),]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
    public function sewing($id,$value){
        try{
            Cars::find($id)->update([
                'used_cart'=>$value
            ]);
            $this->row_background_color='table-success';
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success'),]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
}
