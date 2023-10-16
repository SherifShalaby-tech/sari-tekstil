@extends('layouts.app')
@section('title', __('lang.add_original_stock'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">E-Commerce</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">{{__('lang.original_stock')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.add_original_stock')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
@endsection
@section('content')
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-12">
            <div class="card m-b-30 p-2">
                <div class="container">
                    {!! Form::open(['route' => 'nationality.store', 'method' => 'post', 'files' => true,'id' =>'nationality-form' ]) !!}
                    <div class="modal-body">
                        <div class="col-md-3 form-group">
                            {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                            {!! Form::label('name', __( 'lang.transaction_number' ) ) !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.transaction_number' ), 'required'
                            ]);
                            !!}
                            @error('transaction_number')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                        <div  class="col-md-3 form-group">
                            <label class="h6 pt-3">{{__( 'lang.store' )}}</label>
                            <select wire:model="selectedStore" class="form-control ">
                                <option value="">Select Store</option>
                                @foreach ($stores as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
                        <button  id="create-nationality-btn" class="btn btn-primary">{{__('lang.save')}}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection