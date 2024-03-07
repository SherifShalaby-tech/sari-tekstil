@extends('layouts.app')
@section('title', __('lang.edit_introduction_sheet'))

@section('page_title')
    @lang('lang.edit_introduction_sheet')
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.edit_introduction_sheet')</a></li>
@endsection
@section('content')
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">@lang('lang.edit_introduction_sheet')</h5>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                            'route' => ['introduction-sheet.update', $introductionSheet->id],
                            'method' => 'post',
                            'files' => true,
                            'id' => 'introduction-sheet-form',
                        ]) !!}
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                {{-- +++++++++++++++++++ car_sku +++++++++++++++++++ --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('car_sku', __('lang.car_sku') . ':*') !!}
                                        {!! Form::text('car_sku', old('car_sku', $introductionSheet->car_sku), [
                                            'class' => 'form-control',
                                            'placeholder' => __('lang.sku'),
                                        ]) !!}
                                        @error('car_sku')
                                            <label class="text-danger error-msg">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                {{-- +++++++++++++++++++ process_type +++++++++++++++++++ --}}
                                <div class="col-md-6">
                                    {!! Form::label('process_type', __('lang.process_type'), ['class' => 'h6 pt-3']) !!}
                                    {!! Form::select('process_type', $processes, old('process_type', $introductionSheet->process_type), [
                                        'class' => 'form-control select2 required',
                                        'placeholder' => __('lang.please_select'),
                                        'id' => 'process_type_id',
                                    ]) !!}
                                    @error('process_type')
                                        <label class="text-danger error-msg">{{ $message }}</label>
                                    @enderror
                                </div>
                                {{-- +++++++++++++++++++ process +++++++++++++++++++ --}}
                                {{-- <div class="col-md-6">
                                    {!! Form::label('process', __('lang.process'), ['class' => 'h6 pt-3']) !!}
                                    {!! Form::select(
                                        'process',
                                        [],
                                        old('process', $introductionSheet->process),
                                        ['class' => 'form-control select2 required', 'placeholder' => __('lang.please_select'), 'id' => 'process_id']
                                    ) !!}
                                    @error('process')
                                        <label class="text-danger error-msg">{{ $message }}</label>
                                    @enderror
                                </div> --}}
                                <div class="col-md-6">
                                    {!! Form::label('process', __('lang.process'), ['class' => 'h6 pt-3']) !!}
                                    {!! Form::select(
                                        'process',
                                        [], // Replace with the actual options from the database
                                        old('process', $introductionSheet->process),
                                        ['class' => 'form-control select2 required', 'placeholder' => __('lang.please_select'), 'id' => 'process_id'],
                                    ) !!}
                                    @error('process')
                                        <label class="text-danger error-msg">{{ $message }}</label>
                                    @enderror
                                </div>

                                {{-- +++++++++++++++++++ calibars +++++++++++++++++++ --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="caliber">@lang('lang.calibars')</label>
                                        {!! Form::select('caliber', $caliber, old('caliber', $introductionSheet->caliber), [
                                            'class' => 'form-control',
                                            'required',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                        @error('caliber')
                                            <label class="text-danger error-msg">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                {{-- +++++++++++++++++++ car_barcode +++++++++++++++++++ --}}
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('car_barcode', __('lang.car_barcode') . ':*') !!}
                                        {!! Form::text(
                                            'car_barcode',
                                            old('car_barcode', $introductionSheet->car_barcode),
                                            ['class' => 'form-control', 'placeholder' => __('lang.car_barcode')]
                                        ) !!}
                                        @error('car_barcode')
                                            <label class="text-danger error-msg">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- +++++++++++++++++++ save button +++++++++++++++++++ --}}
                                <div class="col-md-12">
                                    <button id="create-nationality-btn"
                                        class="btn btn-primary">{{ __('lang.save') }}</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
