<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-md-3 mb-3 px-4">
                <label class="form-label">{{ __('lang.supplier') }}</label>
                <select wire:model="selectedSupplier" class="form-control ">
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            {{--  --}}
            <div class="col-md-3 mb-3 px-4">
                <label class="form-label">{{ __('lang.nationality') }}</label>
                <select wire:model="selectedNationality" class="form-control ">
                    <option value="">Select Nationality</option>
                    @foreach ($nationalities as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3 px-4">
                <label class="form-label">{{ __('lang.store') }}</label>
                <select wire:model="selectedStore" class="form-control ">
                    <option value="">Select Store</option>
                    @foreach ($stores as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="shipmentNumber" wire:model="shipmentNumber" class="form__field ">
                    <label class="form__label" for="shipment_number">{{ __('lang.shipment_number') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="sku" wire:model="sku" class="form__field ">
                    <label class="form__label" for="sku">{{ __('lang.sku') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="shipmentWeight" wire:model="shipmentWeight" class="form__field ">
                    <label class="form__label" for="shipment_weight">{{ __('lang.shipment_weight') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 px-4">
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
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="price" wire:model="price" class="form__field">
                    <label class="form__label" for="price">{{ __('lang.price') }}</label>
                </div>
            </div>
            {{-- <div class="col-md-3 mb-3 form-group">
            <label class="h6 pt-3" for="wet_weight">{{__( 'lang.wet_weight' )}}</label>
            <input type="number" id="wetWeight" wire:model="wetWeight" class="form-control ">
        </div>
        <div class="col-md-3 mb-3 form-group">
            <label class="h6 pt-3" for="dry_weight">{{__( 'lang.dry_weight' )}}</label>
            <input type="number" id="dryWeight" wire:model="dryWeight" class="form-control ">
        </div> --}}
            {{-- <div class="col-md-3 mb-3 form-group">
            <label class="h6 pt-3" for="dry_weight">{{__( 'lang.dry_weight' )}}</label>
            <input type="number" id="dryWeight" wire:model="dryWeight" class="form-control ">
        </div> --}}
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input disabled value="{{ $totalWeight }}" class="form__field">
                    <label class="form__label" for="total_weight">{{ __('lang.total_weight') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 px-4">
                <label class="form-label">{{ __('lang.payment_status') }}</label>
                <select wire:model="paymentStatus" class="form-control ">
                    <option value="">{{ __('lang.payment_status') }}</option>
                    <option value="paid">{{ __('lang.paid') }}</option>
                    <option value="pending">{{ __('lang.pay_later') }}</option>
                    <option value="partial">{{ __('lang.paid_partially') }}</option>
                </select>
            </div>

            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="shippingCost" wire:model="shippingCost" class="form__field ">
                    <label class="form__label" for="shipping_cost">{{ __('lang.shipping_cost') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="clearanceCost" wire:model="clearanceCost" class="form__field ">
                    <label class="form__label" for="clearance_cost">{{ __('lang.clearance_cost') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="internalTransportCost" wire:model="internalTransportCost"
                        class="form__field ">
                    <label class="form__label"
                        for="internal_transport_cost">{{ __('lang.internal_transport_cost') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="internalLoadCost" wire:model="internalLoadCost" class="form__field ">
                    <label class="form__label" for="internal_load_cost">{{ __('lang.internal_load_cost') }}</label>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <div class="form__group">
                    <input type="number" id="fines" wire:model="fines" class="form__field ">
                    <label class="form__label" for="fines">{{ __('lang.fines') }}</label>
                </div>
            </div>

            <div class="col-md-3"></div>


            <div class="col-md-12 mb-3 px-4">
                <label class="form-label" for="other_costs">Other Costs</label>
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
                        <div class="col-md-2 mb-2">
                            <input type="text" wire:model="otherCosts.{{ $index }}.key"
                                class="form__field">
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="text" wire:model="otherCosts.{{ $index }}.value"
                                class="form__field">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <input disabled class="form__field" value="{{ $pricePerKilo }}">
                <label class="form__label">{{ __('lang.price_per_kilo') }}</label>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-end px-4">
                <input type="number" id="shipmentName" wire:model="shipmentName" class="form__field ">
                <label class="form__label" for="shipment_name">{{ __('lang.shipment_name') }}</label>
            </div>
            <div class="col-md-3 mb-3 px-4">
                <label class="from-label" for="upload_files">{{ __('lang.upload_files') }}</label>
                <input type="file" name="upload_files[]" wire:model="upload_files" multiple>
            </div>

        </div>
        <div class="col-md-3 ">
            <button type="submit" class="px-3 py-2 submit-button">
                <span class="transition"></span>
                <span class="gradient"></span>
                <span class="label">@lang('lang.save')</span>
            </button>
        </div>
    </form>
</div>
