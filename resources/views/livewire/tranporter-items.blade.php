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
                        <th>@lang('lang.recent_car_content')</th>
                        <th>@lang('lang.batch_number')</th>
                        <th>@lang('lang.shipment_number')</th>
                        <th>@lang('lang.type')</th>
                        <th>@lang('lang.price_per_kilo')</th>
                        <th>@lang('lang.recent_process')</th>
                        {{-- <th class="text-center">@lang('lang.status')</th> --}}
                        <th>@lang('lang.caliber')</th>
                        <th>@lang('lang.next_place')</th>
                        <th>@lang('lang.next_employee')</th>
                        <th>@lang('lang.fill')</th>
                        <th>@lang('lang.color')</th>
                        <th>@lang('lang.weight_product')</th>
                        <th>@lang('lang.requested_weight')</th>
                        <th></th>
                        {{-- <th>@lang('lang.sewing')</th>

                        <th>@lang('lang.print')</th> --}}
                        {{-- <th>@lang('lang.action')</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cars as $index=>$car)
                    @php  $hideBtn='hide'; @endphp
                    <tr class="{{$row_background_color}}">
                        <td>{{ $index+1 }}</td>
                        {{-- <td>{{$car->branch->name}}</td> --}}
                        <td>{{$car->sku}}</td>
                        {{-- <td>{{$car->name}}</td> --}}
                        <td>{{@num_format($car->weight_empty)}} KG</td>
                        <td>{{$car->updated_at->format('d-M-Y')}}</td>
                        <td class="text-center">
                            @foreach($car->car_extras as $employe)
                            @if (!is_null($employe->employee_id))
                                {{$employe->employee->name??'-'}} <br>
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($car->car_contents as $content)
                                {{$content->nationality->name??''}}-{{$content->percentage??'0'}}%  <br>
                            @endforeach
                        </td>
                        <td>{{$car->batch_number??'-'}}</td>
                        <td>{{$car->shipment_number??'-'}}</td>
                        <td>{{$car->type->name??'-'}}</td>
                        <td></td>
                        <td>{{isset($car->process)?__('lang.'.$car->process):""}}</td>
                        {{-- <td>
                            @if($car->status==0)
                                <span>@lang('lang.empty')</span>
                            @else
                                <span>@lang('lang.occuppied')</span>
                            @endif    
                        </td> --}}
                        <td>
                            @foreach($car->car_extras as $cali)
                            @if (!is_null($cali->caliber_id))
                                {{$cali->caliber->number??'-'}}<br>
                                @php  $hideBtn='show'; @endphp
                            @endif
                            @endforeach
                        </td>
                        <td>{{$car->next_place??'-'}}</td>
                        <td>
                            @foreach($car->car_extras as $next_emp)
                            @if (!is_null($next_emp->next_employee_id))
                                {{$next_emp->next_employee->name??''}}<br>
                                @php  $hideBtn='show'; @endphp
                            @endif
                            @endforeach
                        </td>
                        <td>{{$car->fills->name??'-'}}</td>
                        <td>{{$car->color->name??'-'}}</td>
                        <td>{{@num_format($car->weight_product??0)}} KG</td>
                        <td></td>
                        <td class="justify-content-between d-flex">
                            @if($car->used_cart=="used")
                            <button class="btn btn-danger" {{$car->used_cart=="sewing"?'disabled':''}} wire:click="move({{$car->id}})">@lang('lang.move')</button>
                            @elseif($car->used_cart=="not_used")
                            <button class="btn btn-success" {{$car->used_cart=="sewing"?'disabled':''}} wire:click="useCar({{$car->id}})">@lang('lang.use')</button>
                            @endif
                            &nbsp;
                            @if($car->used_cart=="sewing")
                                <button class="btn btn-warning" wire:click="sewing({{$car->id}},'not_used')"><i class="fa fa-wrench"></i></button>
                            @else
                            <button class="btn btn-outline-warning" {{$car->used_cart=="used"?'disabled':''}} wire:click="sewing({{$car->id}},'sewing')"><i class="fa fa-wrench"></i></button>
                            @endif
                            &nbsp;
                            <span class="btn btn-info print"><i class="fa fa-print"></i></span>
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
