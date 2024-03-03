@extends('layouts.app')
@section('title', __('lang.filling_admin_requests'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.filling_admin_requests')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('filling-admin-requests.index')}}">{{__('lang.filling_admin_requests')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.filling_admin_requests')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                <div class="card m-b-30 p-2">
                     {!! Form::open(['route' => ['filling-admin-requests.update',$opening_requests->id],'method'=>'put','id'=>'car-update-form' ]) !!}
                     @csrf
                     @method('PUT')
                    <div class="nationalities">
                        @foreach($fillingrequests as $index=>$nationality)
                        <table id="main">
                            {{-- <th> --}}
                                <button type="button" @if(isset($hideBtn) && $hideBtn != 2)
                                style="display:none; margin-bottom: 10px;"
                                @else style="margin-bottom: 10px"  @endif
                                    class="btn btn-primary btn-sm ml-2 add_row" value="Add New Row" onclick="addRow();" data-index="{{ $index }}" id="rowButton"><i class="fa fa-plus"></i></button>
                            {{-- </th> --}}
                            <th class="head"><select  name=filling_id[] class="form-control selectpicker" data-live-search="true" style="display:inline !important">
                                @foreach ($fills as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                              </select></th>
                            <th class="head"><input name="empty_weight[]" class="form-control" type="number" placeholder="Emty Weight"></th>
                            <th class="head"><select  name=screening_id[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
                                @foreach ($screening as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                              </select></th>
                            <th class="head"><select  name="calibers[{{ $index }}][]" style="display:inline !important" class="form-control selectpicker" data-live-search="true" multiple>
                            @foreach ($calibers as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                            </select></th>
                            <th class="head"><select  name=employee_id[] style="display:inline !important" class="form-control selectpicker" data-live-search="true">
                                <option value="">Select</option>
                                @foreach ($employees as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                                </select></th>
                            <th class="head"><input name="requested_weight[]"class="form-control" type="number" placeholder="Requested weight"></th>
                            <th class="head"><input name="quantity[]"class="form-control" type="number" placeholder="quntity"></th>
                            <th class="head"><select  name=color_id[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
                                @foreach ($colors as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                                </select></th>
                                <th class="head"><select  name=destinations[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
                                        <option value="store">Store</option>
                                        <option value="square">Square</option>
                                        <option value="number">Number</option>
                                    </select></th>
                                <th>
                                    <button type="button"
                                    class="btn btn-primary btn-sm ml-2"  onclick="printRow(this)" id="rowButton"><i class="fa fa-print"></i></button>
                                </th>
                                <th>
                                    <button type="button" @if(isset($hideBtn) && $hideBtn == 0)  style="display:inline;" @else style="display:none; "@endif
                                        class="btn btn-danger btn-sm ml-2 remove_row"><i class="fa fa-close"></i></button>
                               </th>
                        </table>
                        @endforeach
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-3 pt-5">
                            <button type="submit" class="btn btn-danger mr-3">@lang('lang.save')</button>
                            <button type="button" class="btn btn-primary ">@lang('lang.print')</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
{{-- @push('javascripts')
    <script src="{{ asset('app-js/filling-admin-requests.js') }}"></script>
@endpush --}}
