<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Nationality;
use App\Models\OriginalStock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Type;
use Livewire\Component;
use Illuminate\Support\Str;

class AddOriginalStock extends Component
{
    public $suppliers;
    public $branches;
    public $nationalities;
    public $stores;
    public $types;

    public $selectedSupplier;
    public $selectedBranch;
    public $selectedNationality;
    public $selectedStore;
    public $selectedType;
    public $shipmentNumber;
    public $shipmentWeight = 0;
    public $wetWeight = 0;
    public $dryWeight = 0;
    public $totalWeight = 0;
    public $actualWeight = 0;
    public $paymentStatus;
    public $shipmentName;
    public $price;
    public $shippingCost;
    public $clearanceCost;
    public $internalTransportCost;
    public $internalLoadCost;
    public $pricePerKilo;
    public $otherCosts;
    public $fines;
    public $sku;

    public function mount()
    {
        $this->suppliers = Supplier::pluck('name', 'id');
        $this->branches = Branch::pluck('name', 'id');
        $this->nationalities = Nationality::pluck('name', 'id');
        $this->stores = Store::pluck('name', 'id');
        $this->types = Type::pluck('name','id');
    }
     public function updatedPrice($value)
    {
        $this->calculatePricePerKilo();
    }
    public function updatedWetWeight($value)
    {
        if($this->wetWeight != 0 && $this->dryWeight != 0){
            $this->totalWeight = $this->wetWeight - $this->dryWeight;
        }else{
            $this->totalWeight = $this->actualWeight;
        }
       
        $this->calculatePricePerKilo();
    }
    private function calculatePricePerKilo()
    {
        if ($this->totalWeight != 0) {
            $this->pricePerKilo = ($this->price + $this->shippingCost + $this->clearanceCost + $this->internalTransportCost + $this->internalLoadCost)/ $this->totalWeight;
        } else {
            $this->pricePerKilo = 0;
        }
    }
    public function render()
    {
        return view('livewire.add-original-stock');
    }

    public function save()
    {
        // $this->validate([
        //     'selectedSupplier' => 'required',
        //     'selectedStore' => 'required',
            
        // ]);

        // Generate the barcode (as shown in the previous steps)
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 12;
        $barcode = '';

        for ($i = 0; $i < $length; $i++) {
            $barcode .= $characters[rand(0, strlen($characters) - 1)];
        }
        // Check if the barcode already exists
        $existingSku = OriginalStock::where('sku', $barcode)->first();

       
        // Create a new instance of your model and set the attributes
        $originalStock = new OriginalStock();
        $originalStock->supplier_id = $this->selectedSupplier;
        $originalStock->store_id = $this->selectedStore;
        $originalStock->nationality_id = $this->selectedNationality;
        $originalStock->type_id = $this->selectedType;
        $originalStock->shipment_number = $this->shipmentNumber;
        $originalStock->shipment_weight = $this->shipmentWeight;
        $originalStock->actual_weight = $this->actualWeight;
        $originalStock->wet_weight = $this->wetWeight;
        $originalStock->dry_weight = $this->dryWeight;
        $originalStock->payment_status = $this->paymentStatus;
        $originalStock->price = $this->price;
        $originalStock->shipment_name = $this->shipmentName;
        $originalStock->shipping_cost = $this->shippingCost;
        $originalStock->internal_transport_cost = $this->internalTransportCost;
        $originalStock->internal_load_cost = $this->internalLoadCost;
        $originalStock->total_weight = $this->totalWeight;
        $originalStock->price_per_kilo = $this->pricePerKilo;
        $originalStock->other_costs = $this->otherCosts;
        $originalStock->sku = $this->sku ?? Str::random(12);  
 
        // Set other attributes

        // Save the model
        $originalStock->save();

        // Clear the input fields after saving
        // $this->resetFields();

        $output = [
            'success' => true,
            'msg' => __('lang.success')
        ];
        $this->redirect(route('original-stock-create'));
        // return redirect()->back()->with('status', $output);
    }
}
