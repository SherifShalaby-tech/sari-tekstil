@extends('layouts.app')
@section('title', __('lang.filling'))

@section('page_title')
    @lang('lang.filling')
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('original-store-worker-filling.index') }}">{{ __('lang.filling') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.filling')</a></li>
@endsection

@section('content')

    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">

                {!! Form::open(['route' => ['original-store-worker-filling.update', $fill->id], 'method' => 'put']) !!}
                @csrf
                @method('PUT')
                <div class="card p-2 mb-2">
                    <div class="row">
                        <div class="col-md-3 px-4 mb-2">
                            {!! Form::label('type_id', __('lang.type') . '*', ['class' => 'form-label']) !!}
                            {!! Form::select('type_id', $types, $fill->type_id, [
                                'class' => 'form-control selectpicker',
                                'data-live-search' => 'true',
                                'required',
                                'placeholder' => __('lang.please_select'),
                            ]) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4 mb-2">
                            <div class="form__group">

                                {!! Form::number('net_weight', $fill->net_weight, [
                                    'class' => 'form__field net_weight',
                                    'placeholder' => '0.00',
                                    'required',
                                ]) !!}
                                {!! Form::label('net_weight', __('lang.net_weight') . '*', ['class' => 'form__label']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end px-4 mb-2">
                            <div class="form__group">

                                {!! Form::number('batch_number', $fill->batch_number, [
                                    'class' => 'form__field',
                                    'placeholder' => __('lang.batch_number'),
                                ]) !!}
                                {!! Form::label('batch_number', __('lang.batch_number'), ['class' => 'form__label']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 px-4 mb-2">
                            {!! Form::label('sku', __('lang.sku') . '*', ['class' => 'form-label']) !!}
                            {!! Form::select('sku', $skus, $fill->car_id, [
                                'class' => 'form-control sku selectpicker',
                                'data-live-search' => 'true',
                                'required',
                                'placeholder' => __('lang.please_select'),
                            ]) !!}
                        </div>
                        <div class="col-md-3 px-4 mb-2">

                            {{-- {{$processes}}
                            {{$fill->process}} --}}
                            {!! Form::label('process', __('lang.table') . '*', ['class' => 'form-label']) !!}
                            {!! Form::select('process', $processes, $fill->process, [
                                'class' => 'form-control selectpicker',
                                'data-live-search' => 'true',
                                'required',
                                'placeholder' => __('lang.please_select'),
                            ]) !!}
                        </div>
                        <div class="col-md-3 px-4 mb-2">

                            {!! Form::label('workers', __('lang.employees') . '*', ['class' => 'form-label']) !!}
                            {!! Form::select('workers[]', $employees, $fill->workers, [
                                'class' => 'form-control selectpicker',
                                'data-live-search' => 'true',
                                'required',
                                'data-placeholder' => __('lang.please_select'),
                                'multiple',
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2 title">
                            <h4>@lang('lang.add_nationalities')</h4>
                        </div>
                    </div>
                    <div class="nationalities">
                        @php
                            $hideBtn = 2;
                        @endphp
                        @if (!empty($fill->car_contents))
                            @foreach ($fill->car_contents as $index => $f_store)
                                @include('workers.original_stocks.partials.add_nationalities', [
                                    'f_store' => $f_store,
                                    'index' => $index,
                                    'hideBtn' => $hideBtn,
                                ])
                            @endforeach
                        @else
                            @include('workers.original_stocks.partials.add_nationalities')
                        @endif
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <button type="submit" class="px-3 py-2 submit-button">
                                <span class="transition"></span>
                                <span class="gradient"></span>
                                <span class="label">@lang('lang.save')</span>
                            </button>
                            <button type="button" class="px-3 py-2 print-button">
                                <span class="transition"></span>
                                <span class="gradient"></span>
                                <span class="label">@lang('lang.print')</span>
                            </button>
                        </div>
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
@push('javascripts')
    <script src="{{ asset('app-js/original-store-worker.js') }}"></script>
@endpush
