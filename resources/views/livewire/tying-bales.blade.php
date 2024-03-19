<div>
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-3">
            <div class="input-group">
                <input type="text" wire:model="search" placeholder="{{ __('lang.bale_sku') }}..." class="form-control">

                <div class="input-group-append">
                    <button class="btn btn-default input-group-text" wire:click="addBale()"><i
                            class="ri-add-line align-middle"></i></button>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-2 my-2">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('lang.bale') }} 1</th>
                                <th scope="col">{{ __('lang.bale') }} 2</th>
                                <th scope="col">{{ __('lang.bale') }} 3</th>
                                <th scope="col">{{ __('lang.bale') }} 4</th>
                                <th scope="col">{{ __('lang.tie') }}</th>
                                <th scope="col">{{ __('lang.print') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @for ($i = 0; $i < count($bales); $i++) --}}
                            @if (!empty($object))
                                <tr>
                                    @for ($x = 0; $x < count($object); $x++)
                                        <td>{{ $object[$x] }} <button class="btn btn-default text-danger"
                                                wire:click="cancelBale({{ $x }})"><i
                                                    class="fa fa-close"></i></button></td>
                                    @endfor
                                    @if (count($object) == 4)
                                        <td><button class="btn btn-default input-group-text" wire:click="saveTie"
                                                title="{{ __('lang.tie') }}"><img src="{{ asset('images/tie.jpg') }}"
                                                    width="40" height=23 /></button></td>
                                        <td> <button class="btn btn-info"><i class="fa fa-print"></i></button></td>
                                    @endif
                                </tr>
                            @endif

                            {{-- @endfor --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- @if (!empty($car)) --}}
    {{-- <div class="row pt-3">
                <div class="col-lg-2 col-xl-2">
                    <span class="font-weight-bold">@lang('lang.sku') </span><br><span>{{$car->sku}}</span>
                </div>
                <div class="col-lg-2 col-xl-2">
                    <span class="font-weight-bold">@lang('lang.recent_car_content') </span><br><span class="text-primary">{{$car->screening->name}}</span>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <span class="font-weight-bold">@lang('lang.total_weight') </span><br><span class="text-primary">{{$car->weight_product}}</span>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <span class="font-weight-bold">@lang('lang.requested_weight') </span><br><span class="text-primary">{{$weight}}</span>
                </div>

        </div> --}}
    {{-- <div class="row pt-3">
            @for ($i = 1; $i <= $quantity; $i++)
                <div class="col-lg-4 col-xl-4">
                </div>
                <div class="col-lg-3 col-xl-3">
                <input type="number" value="{{$total_weight- $weight*$i}}"  placeholder="{{__('lang.total_weight')}}" class="form-control mt-3">
                </div>
                <div class="col-lg-1 col-xl-1 text-center pt-3">
                    <button class="btn btn-default {{isset($class[$i])?$class[$i]:'text-danger'}}" wire:click="press_bale({{$i}},{{$total_weight- $weight*$i}})"><i class="fa fa-stop-circle"></i></button>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <div class="input-group mb-3 pt-3">
                        <input type="number" wire:model="rows.{{ $i }}.bale_weight" placeholder="{{__('lang.weight')}}" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-default input-group-text"><img src="{{asset('images/balance.jpg')}}" width="40" height=23/></button>
                        </div>
                      </div>



                </div>
                <div class="col-lg-1 col-xl-1 text-center pt-3">
                    <button class="btn btn-info"><i class="fa fa-print"></i></button>
                </div>
            @endfor
        </div> --}}
    {{-- <div class="row pt-3">
            <div class="col-md-4 col-xl-4"></div>
            <div class="col-md-3 col-xl-3 font-weight-bold">
                @lang('lang.remaining_amount') :{{$total_weight- $weight*$quantity}}
            </div>
            <div class="col-md-1 col-xl-1 text-center">
                @lang('lang.count') : {{$quantity}}
            </div>
            <div class="col-md-3 col-xl-3"></div>
        </div> --}}
    {{-- @endif --}}
</div>
