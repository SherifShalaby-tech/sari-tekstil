@extends('layouts.app')
@section('title', __('lang.settings'))
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-css/crop.css') }}">
@endpush
@section('page_title')
    {{ __('lang.settings') }}
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('employees.index') }}">{{ __('lang.employees') }}</a></li>
    <li class="last active"><a href="#">@lang('lang.settings')</a></li>

@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => 'settings.updateGeneralSettings',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card p-2 mb-2">
                    <div class="row">

                        <div class="col-md-3 d-flex align-items-end  px-4 mb-3">
                            <div class="form__group field">
                                {!! Form::text('site_title', !empty($settings['site_title']) ? $settings['site_title'] : null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('site_title', __('lang.site_title'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end  hide mb-3">
                            <div class="form__group field">
                                {!! Form::text('developed_by', !empty($settings['developed_by']) ? $settings['developed_by'] : null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('developed_by', __('lang.developed_by'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('time_format', __('lang.time_format'), ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'time_format',
                                ['12' => '12 hours', '24' => '24 hours'],
                                !empty($settings['time_format']) ? $settings['time_format'] : null,
                                ['class' => 'form-control select2'],
                            ) !!}
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('language', __('lang.language'), ['class' => 'form-label']) !!}
                            {!! Form::select('language', $languages, !empty($settings['language']) ? $settings['language'] : null, [
                                'class' => 'form-control select2',
                            ]) !!}
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('currency', __('lang.currency'), ['class' => 'form-label']) !!}
                            {!! Form::select('currency', $currencies, !empty($settings['currency']) ? $settings['currency'] : null, [
                                'class' => 'form-control select2',
                                'placholder' => __('lang.please_select'),
                            ]) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end  px-4 mb-3">
                            <div class="form__group field">
                                {!! Form::text(
                                    'discount_per_kilo',
                                    !empty($settings['discount_per_kilo']) ? $settings['discount_per_kilo'] : null,
                                    [
                                        'class' => 'form__field',
                                    ],
                                ) !!}
                                {!! Form::label('discount_per_kilo', __('lang.discount_per_kilo'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        {{-- +++++++++++++++ Packing tape : شريط التغليف +++++++++++++++ --}}
                        <div class="col-md-3 d-flex align-items-end  px-4 mb-3">
                            <div class="form__group field">
                                {!! Form::text('packing_tape', !empty($settings['packing_tape']) ? $settings['packing_tape'] : null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('packing_tape', __('lang.packing_tape') . '(' . __('lang.meter') . ')', [
                                    'class' => 'form__label',
                                ]) !!}
                            </div>
                        </div>
                        {{-- <div class="col-md-3 px-4 mb-3">
                        {!! Form::label('default_payment_type', __('lang.default_payment_type'), ['class' => 'form-label']) !!}
                        {!! Form::select('default_payment_type',['cash'=>__('lang.cash'),'later'=>__('lang.later')], !empty($settings['default_payment_type']) ? $settings['default_payment_type'] : null, [
                            'class' => 'form-control select2',
                        ]) !!}
                            </div> --}}
                        <div class="col-md-3 d-flex align-items-end  px-4 mb-3">

                            <div class="form__group field">
                                {!! Form::text('tax', !empty($settings['tax']) ? $settings['tax'] : null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('tax', __('lang.tax'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('invoice_lang', __('lang.invoice_lang'), ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'invoice_lang',
                                $languages + ['ar_and_en' => 'Arabic and English'],
                                !empty($settings['invoice_lang']) ? $settings['invoice_lang'] : null,
                                ['class' => 'form-control select2'],
                            ) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end  px-4 mb-3">
                            <div class="form__group field">
                                {!! Form::text('watsapp_number', !empty($settings['watsapp_number']) ? $settings['watsapp_number'] : null, [
                                    'class' => 'form__field',
                                    'placholder' => __('lang.watsapp_number'),
                                ]) !!}
                                {!! Form::label('Watsapp Number', __('lang.watsapp_number'), ['class' => 'form__label']) !!}
                            </div>
                        </div>

                        <div class="col-md-12 pt-1">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="container m-0">
                                        <div class="row mx-0" style="border: 1px solid #ddd;padding: 30px 0px;">
                                            <div class="col-12">
                                                <label for="projectinput2" class=" justify-content-center d-flex">
                                                    {{ __('lang.logo') }}</label>
                                            </div>
                                            <div class="col-12 d-flex flex-column">
                                                <div class="d-flex justify-content-center align-items-center">

                                                    <div class="variants">
                                                        <div class='file file--upload w-100'>
                                                            <div class="file-input">
                                                                <input type="file" name="file-input" id="file-input-logo"
                                                                    class="file-input__input" />
                                                                <label class="file-input__label" for="file-input-logo">
                                                                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;
                                                                    <span>Upload file</span></label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="preview-logo-container"
                                                    style="display: flex !important;justify-content:center">
                                                    @if (!empty($settings['logo']))
                                                        <div class="preview">
                                                            <img src="{{ asset('uploads/' . $settings['logo']) }}"
                                                                id="img_logo_footer" alt="">
                                                            <button type="button"
                                                                class="btn btn-xs btn-danger delete-btn remove_image "
                                                                data-type="logo"><i style="font-size: 16px;"
                                                                    class="fa fa-trash"></i></button>
                                                            <span class="btn btn-xs btn-primary  crop-btn"
                                                                id="crop-logo-btn" data-toggle="modal"
                                                                data-target="#logoModal"><i style="font-size: 16px;"
                                                                    class="fas fa-crop"></i></span>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('help_page_content', __('lang.help_page_content'), ['class' => 'form-label']) !!}
                                {!! Form::textarea(
                                    'help_page_content',
                                    !empty($settings['help_page_content']) ? $settings['help_page_content'] : null,
                                    ['class' => 'form-control', 'id' => 'help_page_content'],
                                ) !!}
                            </div>
                        </div>


                        <div id="cropped_logo_images"></div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-3 pt-5">
                            <button type="submit" class="btn btn-primary ">@lang('lang.save')</button>
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
    <div class="modal fade" id="logoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('lang.add_logo')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="croppie-logo-modal" style="display:none">
                        <div id="croppie-logo-container"></div>
                        <button data-dismiss="modal" id="croppie-logo-cancel-btn" type="button"
                            class="btn btn-secondary"><i class="fas fa-times"></i></button>
                        <button id="croppie-logo-submit-btn" type="button" class="btn btn-primary"><i
                                class="fas fa-crop"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('javascripts')
    <link rel="stylesheet" href="//fastly.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="{{ asset('app-js/setting.js') }}"></script>


    <script>
        // edit Case
        @if (!empty($settings['logo']) && isset($settings['logo']))
            document.getElementById("crop-logo-btn").addEventListener('click', () => {

                console.log(("#logoModal"))
                setTimeout(() => {
                    launchLogoCropTool(document.getElementById("img_logo_footer"));
                }, 500);
            });
            let deleteLogoBtn = document.getElementById("deleteBtn");
            if (deleteLogoBtn) {
                deleteLogoBtn.getElementById("deleteBtn").addEventListener('click', () => {
                    if (window.confirm('Are you sure you want to delete this image?')) {
                        $("#preview").remove();
                    }
                });
            }
        @endif
    </script>
@endpush
