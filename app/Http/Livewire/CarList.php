<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Caliber;
use App\Models\Cars;
use App\Models\Employee;
use App\Models\Opening;
use App\Models\Screening;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;

class CarList extends Component
{
    public function render()
    {
        $disabled=false;
        if(auth()->user()->can('settings_module.cars.edit')){
            $disabled=true;
        }
        // $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('recent_car_content');
        // $recent_car_contents->prepend( __('lang.empty'));
        // $recent_car_contents=$recent_car_contents->all();
        $cars=Cars::with('car_extras')->
        when(\request()->branch_id != null, function ($query) {
            $query->where('branch_id',\request()->branch_id);
        })
        ->when(\request()->employee_id != null, function ($query) {
            $query->where('employee_id',\request()->employee_id);
        })
        ->when(\request()->recent_process != null, function ($query) {
            $query->where('process',\request()->recent_process);
        })
        ->when(\request()->caliber_id != null, function ($query) {
            $query->where('caliber_id',\request()->caliber_id);
        })
        // ->when(\request()->recent_car_content != null, function ($query) {
        //     if(request()->recent_car_content==0){
        //         $query->whereNull('recent_car_content');
        //     }else{
        //         $recent_car_contents=Cars::whereNotNull('recent_car_content')->latest()->distinct('recent_car_content')->pluck('recent_car_content');
        //         $recent_car_contents->prepend( __('lang.empty'));
        //         $recent_car_contents=$recent_car_contents->all();
        //         $query->where('recent_car_content',$recent_car_contents[request()->recent_car_content]);
        //     }
        // })
        ->when(\request()->created_by != null, function ($query) {
            $query->where('created_by',\request()->created_by);
        })
        ->when(\request()->input('empty_carts_val')==true, function ($query) {
            $query->where('weight_empty','=',0);
        })
        ->when(\request()->input('occupied_carts_val') ==true, function ($query) {
            $query->where('weight_empty','>=',0);
        })->
        latest()->get();
        $users=User::latest()->pluck('name', 'id');
        $stores =Store::latest()->pluck('name', 'id');
        $branches=Branch::latest()->pluck('name', 'id');
        $calibars=Caliber::latest()->pluck('number', 'id');
        $processes=Cars::getProcesses();
        $employees=Employee::latest()->pluck('name', 'id');
         ////to get places concat////
        $storeNames = Store::latest()->pluck('name');
        $openingNames = Opening::latest()->pluck('name');
        $screeningNames = Screening::latest()->pluck('name');
        $places = $storeNames->concat($openingNames)->concat($screeningNames);
        $places->push( __('lang.square'));
        $places=$places->all();
        ///////
        // $users=User::latest()->get();
        // return view('cars.planning_carts.index',compact('cars','stores','branches',
        // 'calibars','processes','employees','places','disabled','users'));
        return view('livewire.car-list',compact('cars','stores','branches',
        'calibars','processes','employees','places','disabled','users'));
    }
}
