<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-md-3 px-4">
                <label class="form-label">{{ __('lang.supplier') }}</label>
                <select wire:model="selectedSupplier" class="form-control ">
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            {{--  --}}
            <div class="col-md-3 px-4">
                <label class="form-label">{{ __('lang.nationality') }}</label>
                <select wire:model="selectedNationality" class="form-control ">
                    <option value="">Select Nationality</option>
                    @foreach ($nationalities as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 px-4">
                <label class="form-label">{{ __('lang.store') }}</label>
                <select wire:model="selectedStore" class="form-control ">
                    <option value="">Select Store</option>
                    @foreach ($stores as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="shipmentNumber" wire:model="shipmentNumber" class="form__field ">
                    <label class="form__label" for="shipment_number">{{ __('lang.shipment_number') }}</label>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="sku" wire:model="sku" class="form__field ">
                    <label class="form__label" for="sku">{{ __('lang.sku') }}</label>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="shipmentWeight" wire:model="shipmentWeight" class="form__field ">
                    <label class="form__label" for="shipment_weight">{{ __('lang.shipment_weight') }}</label>
                </div>
            </div>
            <div class="col-md-3 px-4">
                <label class="form-label">{{ __('lang.type') }}</label>
                <select wire:model="selectedType" class="form-control ">
                    <option value="">Select Type</option>
                    @foreach ($types as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div  class="col-md-4 form-group">
            <label class="h6 pt-3" for="actual_weight">{{__( 'lang.actual_weight' )}}</label>
            <input type="number" id="actualWeight" wire:model="actualWeight" class="form-control ">
        </div> --}}
            <div class="col-md-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="price" wire:model="price" class="form__field ">
                    <label class="form__label" for="price">{{ __('lang.price') }}</label>
                </div>
            </div>
            {{-- <div class="col-md-3 form-group">
            <label class="h6 pt-3" for="wet_weight">{{__( 'lang.wet_weight' )}}</label>
            <input type="number" id="wetWeight" wire:model="wetWeight" class="form-control ">
        </div>
        <div class="col-md-3 form-group">
            <label class="h6 pt-3" for="dry_weight">{{__( 'lang.dry_weight' )}}</label>
            <input type="number" id="dryWeight" wire:model="dryWeight" class="form-control ">
        </div> --}}
            {{-- <div class="col-md-3 form-group">
            <label class="h6 pt-3" for="dry_weight">{{__( 'lang.dry_weight' )}}</label>
            <input type="number" id="dryWeight" wire:model="dryWeight" class="form-control ">
        </div> --}}
            <div class="col-md-3 form-group">
                <label class="h6 pt-3" for="total_weight">{{ __('lang.total_weight') }}</label>
                <span class="form-control ">{{ $totalWeight }}</span>
            </div>
            <div class=" col-md-3 form-group">
                <label class="h6 pt-3">{{ __('lang.payment_status') }}</label>
                <select wire:model="paymentStatus" class="form-control ">
                    <option value="">{{ __('lang.payment_status') }}</option>
                    <option value="paid">{{ __('lang.paid') }}</option>
                    <option value="pending">{{ __('lang.pay_later') }}</option>
                    <option value="partial">{{ __('lang.paid_partially') }}</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="h6 pt-3" for="shipping_cost">{{ __('lang.shipping_cost') }}</label>
                <input type="number" id="shippingCost" wire:model="shippingCost" class="form-control ">
            </div>
            <div class="col-md-3 form-group">
                <label class="h6 pt-3" for="clearance_cost">{{ __('lang.clearance_cost') }}</label>
                <input type="number" id="clearanceCost" wire:model="clearanceCost" class="form-control ">
            </div>
            <div class="col-md-3 form-group">
                <label class="h6 pt-3" for="internal_transport_cost">{{ __('lang.internal_transport_cost') }}</label>
                <input type="number" id="internalTransportCost" wire:model="internalTransportCost"
                    class="form-control ">
            </div>
            <div class="col-md-3 form-group">
                <label class="h6 pt-3" for="internal_load_cost">{{ __('lang.internal_load_cost') }}</label>
                <input type="number" id="internalLoadCost" wire:model="internalLoadCost" class="form-control ">
            </div>
            <div class="col-md-3 form-group">
                <label class="h6 pt-3" for="fines">{{ __('lang.fines') }}</label>
                <input type="number" id="fines" wire:model="fines" class="form-control ">
            </div>
            <div class=" col-md-12 form-group">
                <label class="h6 pt-3" for="other_costs">Other Costs</label>
                <div class="row">
                    <div class="col-md-2">
                        Key:
                    </div>
                    <div class="col-md-4">
                        Value:
                    </div>
                </div>
                @foreach ($otherCosts as $index => $cost)
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text" wire:model="otherCosts.{{ $index }}.key"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="text" wire:model="otherCosts.{{ $index }}.value"
                                class="form-control">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-3 form-group">
                <label class="h6 pt-3">{{ __('lang.price_per_kilo') }}</label>
                <span class="form-control ">{{ $pricePerKilo }}</span>
            </div>
            <div class=" col-md-3 form-group">
                <label class="h6 pt-3" for="shipment_name">{{ __('lang.shipment_name') }}</label>
                <input type="number" id="shipmentName" wire:model="shipmentName" class="form-control ">
            </div>
            <div class="col-md-3">
                <label class="h6 pt-3" for="upload_files">{{ __('lang.upload_files') }}</label>
                <input type="file" name="upload_files[]" wire:model="upload_files" multiple>
            </div>

        </div>
        <div class="col-md-3 pt-5">
            <button type="submit" class="btn btn-primary ">@lang('lang.save')</button>
        </div>
    </form>
</div>
