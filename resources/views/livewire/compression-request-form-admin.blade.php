<div>
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-3 col-xl-3">
            {{-- <input type="text" wire:model="search" placeholder="{{__('lang.sku')}}..." class="form-control"> --}}
        </div>
    </div>
    <!-- Start row -->
    <div class="row pt-3">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-12">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="table-light">
                            <th scope="col">@lang('lang.filling')</th>
                            <th scope="col">@lang('lang.empty_weight')</th>
                            <th scope="col">@lang('lang.requested')</th>
                            <th scope="col">@lang('lang.caliber')</th>
                            <th scope="col">@lang('lang.weight')</th>
                            <th scope="col">@lang('lang.quantity')</th>
                            <th scope="col">@lang('lang.color')</th>
                            <th scope="col">@lang('lang.destination')</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pressing_requests as $index=>$item)
                            <tr>
                                <th scope="row">{{ $item->fills->name }}</th>
                                <td>{{ $item->empty_weight }} Kg</td>
                                <td>{{ $item->screening->name }}</td>
                                <td>{{ $item->calibers }}</td>
                                <td>{{ $item->weight }} Kg</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->color->name }}</td>
                                <td>{{ $item->destination }}</td>
                                <td>
                                    <a href="{{route('squeeze.edit',$item->id)}}" class="btn btn-default text-danger" title="{{__('lang.squeeze')}}">
                                        <h4 class="{{ $item->status==0?'text-danger':''}}" title="{{__('lang.squeeze')}}">
                                            <i class="fa fa-stop-circle"></i>
                                        </h4>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="12">
                                <div class="float-right">
                                    {!! $pressing_requests->links() !!}
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
{{--
    <div class="row pt-3">
        <div class="col-lg-12 col-xl-12">
            <button wire:click="insertSelectedData" class="btn btn-primary">@lang('lang.save')</button>
            <button wire:click="saveLaterSelectedData" class="btn btn-success">@lang('lang.save_later')</button>
            <button wire:click="cancelSelectedData" class="btn btn-danger">@lang('lang.cancel')</button>
        </div>
    </div> --}}
</div>

