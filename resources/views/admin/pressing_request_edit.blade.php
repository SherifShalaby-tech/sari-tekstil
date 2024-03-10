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
                    'route' => ['pressing-admin-requests.update', $pressing_request_transaction->id],
                    'method' => 'put',
                    'id' => 'filling-request-update-form',
                ]) !!}
                @csrf
                @method('PUT')
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
                                isset($pressing_request_transaction->source) ? $pressing_request_transaction->source : null,
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
                        @foreach ($pressing_request_transaction->pressing_requests as $key => $pressing_request)
                            @include('admin.partials.add_pressing_row', ['index' => $index])
                            @php
                                $index += 1;
                                // echo $index.'99';
                            @endphp
                        @endforeach
                        @php
                            $index -= 1;
                        @endphp
                        <input type="hidden" value="{{ $index }}" class="row_index" />
                    </div>
                    <div class="row justify-content-between mt-2">
                        {{-- <div class="col-md-6 pt-5">
                            {!! Form::label('notes', __( 'lang.notes' )) !!}
                            {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => __( 'lang.notes' ),
                            ]);
                            !!}
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form__group field">
                                {!! Form::text(
                                    'priority',
                                    isset($pressing_request_transaction->priority) ? $pressing_request_transaction->priority : null,
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
    <script src="{{ asset('app-js/pressing_request.js') }}"></script>
    {{-- <script>


    </script> --}}
@endpush
