@extends('layouts.app')
@section('title', __('lang.opening'))

@section('page_title')
    {{ __('lang.opening_requests') }}
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('admin_opening_request.index') }}">{{ __('lang.opening_request') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.opening_request')</a></li>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => ['admin_opening_request.update', $opening_request->id],
                    'method' => 'put',
                    'id' => 'opening_request-update-form',
                ]) !!}
                @csrf
                @method('PUT')
                <div class="card mb-2 p-2">
                    <div class="row">
                        <div class="col-md-3 px-4">
                            {!! Form::label('type_id', __('lang.type') . '*', ['class' => 'form-label']) !!}
                            {!! Form::select('type_id', $types, $opening_request->type_id, [
                                'class' => 'form-control selectpicker',
                                'data-live-search' => 'true',
                                'required',
                                'placeholder' => __('lang.please_select'),
                            ]) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group field">
                                {!! Form::number('requested_weight', $opening_request->requested_weight ?? 0, [
                                    'class' => 'form__field requested_weight',
                                    'placeholder' => '0.00',
                                    'required',
                                ]) !!}
                                {!! Form::label('requested_weight', __('lang.requested_weight') . '*', ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group field">
                                {!! Form::text('batch_number', $opening_request->batch_number ?? $batch_number, [
                                    'class' => 'form__field',
                                    'placeholder' => __('lang.batch_number'),
                                ]) !!}
                                {!! Form::label('batch_number', __('lang.batch_number'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-2 title">
                        <h4>@lang('lang.add_nationalities')</h4>
                    </div>
                </div>
                <div class="card p-2 mb-2">
                    <div class="nationalities">
                        @foreach ($Opening_request_nationality as $index => $Opening_request_nat)
                            @include('admin.partials.add_nationalities')
                        @endforeach
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
    <script src="{{ asset('app-js/opening_request.js') }}"></script>
@endpush
