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
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Redirect;

class EditOriginalStock extends Component
{
    use WithFileUploads;
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
    // public $wetWeight = 0;
    // public $dryWeight = 0;
    public $totalWeight = 0;
    // public $actualWeight = 0;
    public $paymentStatus;
    public $shipmentName;
    public $price;
    public $shippingCost;
    public $clearanceCost;
    public $internalTransportCost;
    public $internalLoadCost;
    public $pricePerKilo;
    public $otherCosts = [
        ['key' => '', 'value' => ''],
        ['key' => '', 'value' => ''],
        ['key' => '', 'value' => ''],
        ['key' => '', 'value' => ''],
        ['key' => '', 'value' => ''],
    ];
    public $fines;
    public $sku , $original_stock;
    public $upload_files = [];

    protected $listeners = ['updatePrices'];


    public function mount($id)
    {
        $this->suppliers = Supplier::pluck('name', 'id');
        $this->branches = Branch::pluck('name', 'id');
        $this->nationalities = Nationality::pluck('name', 'id');
        $this->stores = Store::pluck('name', 'id');
        $this->types = Type::pluck('name','id');
        $this->original_stock = OriginalStock::find($id);
    }
    public function updated($propertyName)
    {
        // This method will be automatically called whenever any property is updated.
        $this->updatedPrice();
        $this->updatedWetWeight();
    }
    public function updatedPrice()
    {
        $this->calculatePricePerKilo();
    }
    public function updatedWetWeight()
    {
        // if($this->wetWeight != 0 && $this->dryWeight != 0){
        //     $this->totalWeight = $this->wetWeight - $this->dryWeight;
        // }else{
            $this->totalWeight = $this->shipmentWeight;
        // }

        $this->calculatePricePerKilo();
    }
    private function calculatePricePerKilo()
    {
        $totalOtherCosts = 0;

        // Summing up the values from otherCosts array
        foreach ($this->otherCosts as $otherCost) {
            $totalOtherCosts += $this->num_uf($otherCost['value']);
        }

        // Summing up all costs
        $totalCosts = $this->num_uf($this->price)
                    + $this->num_uf($this->shippingCost)
                    + $this->num_uf($this->clearanceCost)
                    + $this->num_uf($this->internalTransportCost)
                    + $this->num_uf($this->internalLoadCost)
                    + $totalOtherCosts;

        // Calculate price per kilo
        if ($this->totalWeight > 0) {
            $this->pricePerKilo = $totalCosts / $this->num_uf($this->totalWeight);
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

        if ($this->upload_files && count($this->upload_files) > 0) {
            $files = [];

            foreach ($this->upload_files as $image) {
                $ext = $image->getClientOriginalExtension();
                $filename = rand(1111, 9999) . time() . '.' . $ext;
                $image->storeAs('uploads/original_stock', $filename);
                $files[] = $filename;
            }

            $data['files'] = json_encode($files); // Convert array to JSON
            $originalStock->files =  $data['files'];
        }

        // Save the model
        $originalStock->save();

        // Clear the input fields after saving
        // $this->resetFields();

        $output = [
            'success' => true,
            'msg' => __('lang.success')
        ];
        // Create a redirect response with the output attached as a parameter
        $redirectResponse = Redirect::route('original-stock-create')->with('status', $output);
        // Return the redirect response
        return $redirectResponse;
    }
    public function num_uf($input_number, $currency_details = null){
        $thousand_separator  = ',';
        $decimal_separator  = '.';
        $num = str_replace($thousand_separator, '', $input_number);
        $num = str_replace($decimal_separator, '.', $num);
        return (float)$num;
    }
}
