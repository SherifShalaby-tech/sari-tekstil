<div>
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-3 col-xl-3">
            <input type="text" wire:model="search" placeholder="{{__('lang.sku')}}..." class="form-control">
        </div>
    </div>
    <!-- Start row -->
    {{-- {!! Form::open([
        'route' => 'original-store-worker.store',
        'method' => 'post',
        'files' => true,
        'id' => 'recieve-stock-form',
    ]) !!} --}}
    <div class="row pt-3">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-12">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="table-light">
                            <th scope="col">@lang('lang.sku')</th>
                            <th scope="col">@lang('lang.supplier')</th>
                            <th scope="col">@lang('lang.type')</th>
                            <th scope="col">@lang('lang.nationality')</th>
                            <th scope="col">@lang('lang.shipment_weight')</th>
                            <th scope="col">@lang('lang.actual_weight')</th>
                            <th scope="col">@lang('lang.wet_weight')</th>
                            <th scope="col">@lang('lang.wet_drying')</th>
                            <th scope="col">@lang('lang.net_weight')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index=>$item)
                            <tr class="{{ in_array($item->id, $red_items) ? 'table-danger' : 'table-default' }}">
                                <th scope="row">{{ $item->sku }}</th>
                                <td>{{ !empty($item->supplier)?$item->supplier->name:'' }}</td>
                                <td>{{ $item->type->name }}</td>
                                <td>{{ $item->nationality->name }}</td>
                                <td>{{ @num_format($item->shipment_weight) }}</td>
                                <td>
                                    {{-- <input type="number" wire:model="rows.{{ $item->id }}.id" class = 'form-control id' placeholder="0.00"
                                     style ='width:120px'/> --}}
                                     <input type="number" wire:model="rows.{{ $item->id }}.actualweight" wire:change="index({{$item->id}})" class = 'form-control actual_weight' placeholder="0.00"
                                     style ='width:120px'/>
                                </td>
                                <td>
                                     <input type="number" wire:model="rows.{{ $item->id }}.wetweight" wire:change="index({{$item->id}})" class = 'form-control wet_weight' placeholder="0.00"
                                     style ='width:120px'/>
                                </td>
                                <td>
                                     <input type="number" wire:model="rows.{{ $item->id }}.dryweight" wire:change="index({{$item->id}})" class = 'form-control dry_weight' placeholder="0.00"
                                     style ='width:120px'/>
                                </td>
                                <td>
                                    <input type="number" wire:model="rows.{{ $item->id }}.totalweight" class = 'form-control total_weight' placeholder="0.00"
                                        style ='width:120px'/>
                                </td>
                                <td>
                                    <input type="number" wire:model="rows.{{ $item->id }}.diffwetdry" class = 'form-control total_weight' placeholder="0.00"
                                        style ='width:120px'/>
                                    {{-- <input type="checkbox" wire:model="selectedRows" value="{{ $item->id }}" /> --}}
                                </td>
                                
                                {{-- <td>
                                    {!! Form::select('stock[{{$index}}][color_id]', $colors, null, [
                                        'class' => 'selectpicker form-control color',
                                        'style' => 'width:200px',
                                        'data-live-search' => 'true',
                                        'placeholder' => '-',
                                    ]) !!}
                                </td> --}}
                                {{--<td>
                                    <span class="btn btn-info"><i class="fa fa-print"></i></span>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="12">
                                <div class="float-right">
                                    {!! $items->links() !!}
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="row pt-3">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-12">
            <button wire:click="insertSelectedData" class="btn btn-primary">@lang('lang.save')</button>
            <button wire:click="saveLaterSelectedData" class="btn btn-success">@lang('lang.save_later')</button>
            <button wire:click="cancelSelectedData" class="btn btn-danger">@lang('lang.cancel')</button>
            {{-- <button type="submit" class="btn btn-danger">@lang('lang.save')</button> --}}
        </div>
    </div>
    {{-- {!! Form::close() !!} --}}
</div>
