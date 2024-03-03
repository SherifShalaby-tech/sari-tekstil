@extends('layouts.app')
@section('title', __('lang.screening'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">Tekstil</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.stock_from_other_store')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createStoreModal"><i class="ri-add-line align-middle mr-2"></i>Add</button>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    {{-- @include('stores.create') --}}
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                    <div class="col-md-3">
                        {!! Form::label('batch_number', __('lang.batch_number'), ['class'=>'h6 pt-3']) !!}
                        {!! Form::text('batch_number', $batch_number, [
                            'class' => 'form-control',
                            'placeholder'=>__('lang.batch_number')
                        ]) !!}
                    </div>
                    {!! Form::open(['url' => route('original-stock-create-store'), 'method' => 'get']) !!}
                        <div  class=" col-md-3 form-group">
                            <label class="h6 pt-3">{{__( 'lang.nationality' )}}</label>
                            <select id="branch-select" class="form-control">
                                <option value="">Select Branch</option>
                                @foreach ($branches as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>

                            <select id="store-select" name="store_id" class="form-control">
                                <option value="">Select Store</option>
                            </select>
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['url' => route('original-stock-store-store'), 'method' => 'post']) !!}
                    @csrf
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('lang.asociation_number')</th>
                                <th>@lang('lang.filling')</th>
                                <th>@lang('lang.store')</th>
                                <th>@lang('lang.weight')</th>
                                <th>@lang('lang.production_date')</th>
                                <th>@lang('lang.last_worker_name')</th>
                                <th>@lang('lang.cost')</th>
                                <th>@lang('lang.original_content')</th>
                                <th>@lang('lang.current_content')</th>
                                <th>@lang('lang.caliber')</th>
                                <th>@lang('lang.color')</th>
                                <th>@lang('lang.same')</th>
                                <th>@lang('lang.quantity')</th>
                                <th>@lang('lang.requested')</th>
                                <th>@lang('lang.requested_color')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stores as $index=>$store)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$store->email ?? 'NAN'}}</td>
                                <td>{{$store->manager_name ?? 'NAN'}}</td>
                                <td>{{$store->location ?? 'NAN'}}</td>
                                <td>{{ $index+1 }}</td>
                                <td>{{$store->name}}</td>
                                <td>{{$store->branch->name ?? 'NAN'}}</td>
                                <td>{{$store->phone_number ?? 'NAN'}}</td>
                                <td>{{$store->email ?? 'NAN'}}</td>
                                <td>{{$store->manager_name ?? 'NAN'}}</td>
                                <td>{{$store->location ?? 'NAN'}}</td>
                                <td>{{$store->phone_number ?? 'NAN'}}</td>
                                <td>{{$store->email ?? 'NAN'}}</td>
                                <td><input type="number" name="quantity"></td>
                                <td><select id="process" name="process" class="form-control">
                                    <option value="opening">Opening</option>
                                    <option value="screening">Screnning</option>
                                    <option value="pressing">Pressing</option>
                                </select></td>
                                <td>{{$store->location ?? 'NAN'}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="view_modal no-print" >
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#branch-select').change(function () {
            var branchId = $(this).val();
            if (branchId) {
                $.ajax({
                    type: "GET",
                    url: "/getStores/" + branchId, // Assuming you have a route named 'get-stores' to handle this request
                    success: function (stores) {
                        $('#store-select').empty();
                        $('#store-select').append('<option value="">Select Store</option>');
                        $.each(stores, function (key, value) {
                            $('#store-select').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#store-select').empty();
                $('#store-select').append('<option value="">Select Store</option>');
            }
        });
    });
</script>
@endsection
