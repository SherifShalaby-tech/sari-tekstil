<div>
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-3 col-xl-3">
            <input type="text" wire:model="search" placeholder="{{__('lang.sku')}}..." class="form-control">
        </div>
    </div>
    <!-- Start row -->
    <div class="row pt-3">
        <!-- Start col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-12">
            <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered ">
                    <thead>
                    <tr>
                        <th>#</th>
                        {{-- <th>@lang('lang.branch')</th> --}}
                        <th>@lang('lang.sku')</th>
                        {{-- <th>@lang('lang.name')</th> --}}
                        <th>@lang('lang.weight_empty')</th>
                        <th>@lang('lang.date')</th>
                        <th>@lang('lang.employee')</th>
                        <th>@lang('lang.recent_process')</th>
                        <th>@lang('lang.recent_car_content')</th>
                        <th>@lang('lang.caliber')</th>
                        <th>@lang('lang.weight_product')</th>
                        <th class="text-center">@lang('lang.status')</th>
                        {{-- <th>@lang('lang.action')</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cars as $index=>$car)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        {{-- <td>{{$car->branch->name}}</td> --}}
                        <td>{{$car->sku}}</td>
                        {{-- <td>{{$car->name}}</td> --}}
                        <td>{{@num_format($car->weight_empty)}} KG</td>
                        <td>{{$car->created_at}}</td>
                        <td class="text-center">{{!empty($car->employee)?$car->employee->name:'-'}}</td>
                        <td>{{__('lang.'.$car->process)}}</td>
                        <td class="text-center">
                        {{-- @foreach($cars->filling_by_original_store->filling_by_original_store_nationalities as $fill)
                        
                        @endforeach     --}}
                        {{-- {{$cars->opening_request_nationalities}} --}}
                        {{-- @foreach($cars->opening_request_nationalities as $open)
                        
                        @endforeach  --}}
                        </td>
                        <td class="text-center">{{!empty($car->caliber)?$car->caliber->number:'-'}}</td>
                        <td>{{@num_format($car->weight_product)}} KG</td>
                        <td>
                            @if($car->status==0)
                                <span>@lang('lang.empty')</span>
                            @else
                                <span>@lang('lang.occuppied')</span>
                            @endif    
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="view_modal no-print" >
                </div>
            </div>
    </div>
    <!-- End col -->
    </div>
</div>
