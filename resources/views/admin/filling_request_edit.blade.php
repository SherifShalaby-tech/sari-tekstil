@extends('layouts.app')
@section('title', __('lang.filling'))

@section('page_title')
    @lang('lang.filling_request')
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('original-store-worker-filling.index') }}">{{ __('lang.filling_request') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.filling_request')</a></li>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => ['admin_filling_request.update', $filling_request_transaction->id],
                    'method' => 'put',
                    'id' => 'filling-request-update-form',
                ]) !!}
                @csrf
                @method('PUT')
                <div class="card  p-2 mb-2">
                    <div class="row">

                        <div class="col-md-3">
                            {!! Form::label('type_id', __('lang.source') . '*', ['class' => 'form-label']) !!}
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
                    <div class="row pt-2">
                        <div class="col-md-12">

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
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form__group">

                                {!! Form::text(
                                    'notes',
                                    isset($filling_request_transaction->notes) ? $filling_request_transaction->notes : null,
                                    ['class' => 'form__field', 'placeholder' => __('lang.notes')],
                                ) !!}
                                {!! Form::label('notes', __('lang.notes'), [
                                    'class' => 'form__label',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form__group">
                                {!! Form::text(
                                    'priority',
                                    isset($filling_request_transaction->priority) ? $filling_request_transaction->priority : null,
                                    ['class' => 'form__field', 'placeholder' => __('lang.priority')],
                                ) !!}
                                {!! Form::label('priority', __('lang.priority'), [
                                    'class' => 'form__label',
                                ]) !!}
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
    <script src="{{ asset('app-js/filling_request.js') }}"></script>
    {{-- <script>


    </script> --}}
@endpush
