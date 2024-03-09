@extends('layouts.app')
@section('title', __('lang.pressing'))

@section('page_title')
    @lang('lang.pressing_request')
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('pressing-admin-requests.index') }}">{{ __('lang.pressing_request') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.pressing_request')</a></li>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => 'pressing-admin-requests.store',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card p-2 mb-2">
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('type_id', __('lang.source') . '*', ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'source',
                                [
                                    'original' => 'Original',
                                    'other' => 'Other',
                                ],
                                null,
                                [
                                    'class' => 'form-control selectpicker',
                                    'data-live-search' => 'true',
                                    'required',
                                    'placeholder' => __('lang.please_select'),
                                ],
                            ) !!}
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-md-12">

                        </div>
                    </div>
                    @php
                        $index = 1;
                    @endphp
                    <div class="fillings">
                        @include('admin.partials.add_pressing_row')
                    </div>
                    <div class="row justify-content-between w-50 m-auto">
                        <div class="col-md-3 mt-3">
                            <input type="text" value="{{ $index }}" class="row_index w-100" />
                        </div>
                        {{-- <div class="col-md-6 pt-5">
                            {!! Form::label('notes', __( 'lang.notes' )) !!}
                            {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => __( 'lang.notes' ),
                            ]);
                            !!}
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form__group field">
                                {!! Form::text('priority', null, ['class' => 'form__field', 'placeholder' => __('lang.priority')]) !!}
                                {!! Form::label('priority', __('lang.priority'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
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
    <script src="{{ asset('app-js/pressing_request.js') }}"></script>
    {{-- <script>


    </script> --}}
@endpush
