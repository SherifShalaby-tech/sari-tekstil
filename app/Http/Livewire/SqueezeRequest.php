<?php

namespace App\Http\Livewire;

use App\Models\Caliber;
use App\Models\Cars;
use App\Models\Employee;
use App\Models\FillPressRequest;
use App\Models\Opening;
use App\Models\Screening;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SqueezeRequest extends Component
{
    public $rows = [],$places;
    public function render()
    {
        $cars = Cars::with('car_extras')->where('weight_product','>',0)->latest()->get();
        $calibars = Caliber::latest()->pluck('number', 'id');
        $employees = Employee::latest()->pluck('name', 'id');

        $storeNames = Store::latest()->pluck('name');
        $openingNames = Opening::latest()->pluck('name');
        $screeningNames = Screening::latest()->pluck('name');
        $places = $storeNames->concat($openingNames)->concat($screeningNames);
        $places->push( __('lang.square'));
        $this->places=$places->all();

        return view('livewire.squeeze-request', compact('cars', 'calibars', 'employees'));
    }
    public function updateWeightProduct($index, $value, $car_id,$next_place)
    {
        $this->rows[$index]['car_id'] = $car_id;
        $this->rows[$index]['weight_product'] = $value;
        // $this->rows[$index]['next_place'] = array_search($next_place, $this->places);
    }
    public function updateBaleWeight($index, $value)
    {
        $this->rows[$index]['bale_weight'] = $value;
        if (!empty($this->rows[$index]['weight_product']) && num_uf($this->rows[$index]['weight_product']) > 0) {
            $this->rows[$index]['num_of_bales'] = number_format(num_uf($this->rows[$index]['weight_product']) / num_uf($this->rows[$index]['bale_weight']),3);
            $this->rows[$index]['real_num_of_bales'] = intval(num_uf($this->rows[$index]['num_of_bales']));
        }
        // dd($this->rows);
    }
    public function updateNumBales($index, $value)
    {
        $this->rows[$index]['num_of_bales'] = $value;
        $this->rows[$index]['real_num_of_bales'] = intval(num_uf($this->rows[$index]['num_of_bales']));
        // dd($this->rows);
    }
    public function updateNextPlace($index, $value)
    {
        // dd($value);
        $this->rows[$index]['next_place'] = $value;
        // dd($this->rows);
    }
    public function autommaticSqueeze($index)
    {
        try {
            if ($this->rows[$index]['real_num_of_bales'] == null) {
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.enter_bale_weight')]);
            } else {
                for ($i = 0; $i < num_uf($this->rows[$index]['real_num_of_bales']); $i++) {
                    $fillPressRequest = FillPressRequest::create([
                        'press_request_id' => null,
                        'employee_id' => Employee::find(Auth::user()->id)->id,
                        'sku' => "123456",
                        'weight' => $this->rows[$index]['bale_weight'],
                        'cars_id' => $this->rows[$index]['car_id']
                    ]);
                }
                Cars::find($this->rows[$index]['car_id'])->update([
                    'process' => 'squeeze',
                    'next_place'=>$this->places[$this->rows[$index]['next_place']],
                    'employee_id' => Employee::find(Auth::user()->id)->id,
                    'weight_product' => num_uf(Cars::find($this->rows[$index]['car_id'])->weight_product) -
                        (num_uf($this->rows[$index]['bale_weight']) * num_uf($this->rows[$index]['real_num_of_bales'])),
                ]);
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'message' => __('lang.success')]);
                return redirect()->back();
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'message' => __('lang.something_went_wrongs')]);
        }
    }
}
