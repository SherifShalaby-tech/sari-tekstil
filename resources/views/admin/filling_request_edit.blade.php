@extends('layouts.app')
@section('title', __('lang.filling'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.filling_request')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('lang.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('original-store-worker-filling.index') }}">{{ __('lang.filling_request') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.filling_request')</li>
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
                    {!! Form::open([
                        'route' => ['admin_filling_request.update', $filling_request_transaction->id],
                        'method' => 'put',
                        'id' => 'filling-request-update-form',
                    ]) !!}
                    @csrf
                    @method('PUT')
                    <div class="row">


                        <div class="col-md-3">
                            {!! Form::label('type_id', __('lang.source') . '*', ['class' => 'h6 pt-3']) !!}
                            {!! Form::select(
                                'source',
                                [
                                    'original' => 'Original',
                                    'other' => 'Other',
                                ],
                                isset($filling_request_transaction->source) ? $filling_request_transaction->source : null,
                                [
                                    'class' => 'form-control selectpicker',
                                    'data-live-search' => 'true',
                                    'required',
                                    'placeholder' => __('lang.please_select'),
                                ],
                            ) !!}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-5">

                        </div>
                    </div>
                    <div class="fillings">
                        @php
                            $index = 1;
                        @endphp
                        @foreach ($filling_request_transaction->filling_requests as $key => $filling_request)
                            @include('admin.partials.add_filling_row', ['index' => $index])
                            @php
                                $index += 1;
                            @endphp
                        @endforeach
                        @php
                            $index -= 1;
                        @endphp
                        <input type="hidden" value="{{ $index }}" class="row_index" />
                    </div>
                    <div class="row">
                        <div class="col-md-6 pt-5">
                            {!! Form::label('notes', __('lang.notes')) !!}
                            {!! Form::text(
                                'notes',
                                isset($filling_request_transaction->notes) ? $filling_request_transaction->notes : null,
                                ['class' => 'form-control', 'placeholder' => __('lang.notes')],
                            ) !!}
                        </div>
                        <div class="col-md-2 pt-5">
                            {!! Form::label('priority', __('lang.priority')) !!}
                            {!! Form::text(
                                'priority',
                                isset($filling_request_transaction->priority) ? $filling_request_transaction->priority : null,
                                ['class' => 'form-control', 'placeholder' => __('lang.priority')],
                            ) !!}
                        </div>
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
@push('javascripts')
    <script src="{{ asset('app-js/filling_request.js') }}"></script>
    {{-- <script>
      

    </script> --}}
@endpush
