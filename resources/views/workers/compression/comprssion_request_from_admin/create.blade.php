@extends('layouts.app')
@section('title', __('lang.squeeze'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{ __('lang.squeeze') }}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('lang.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.squeeze')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Breadcrumbbar -->
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <livewire:squeeze-requests :quantity="$pressing_request->quantity" :weight="$pressing_request->weight" :pressingrequestid="$pressing_request->id"/>
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
<script>
    $(document).on('click','.print-staker',function(){
         $.ajax({
            method: "get",
            url: "/print-bale-staker/"+$(this).siblings('.bale_id').val(),
            success: function (response) {
                console.log(response)
                if(response!==''){
                pos_print(response);
                }
            }
        });
    });
    function pos_print(receipt) {
    $("#receipt_section").html(receipt);
    const sectionToPrint = document.getElementById('receipt_section');
    __print_receipt(sectionToPrint);
    }
    function __print_receipt(section= null) {
        setTimeout(function () {
            section.style.display = 'block';
            window.print();
            section.style.display = 'none';

        }, 1000);
    }
</script>
    {{-- <script src="{{ asset('app-js/compression.js') }}"></script> --}}
@endpush
