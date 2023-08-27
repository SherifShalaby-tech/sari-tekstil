<div class="row" style="text-align: center;" id="invoice_heaer_div" >
    @php
        $letter_header = App\Models\System::getProperty('letter_header');
    @endphp
    <img src="{{asset('/uploads/'.session('logo'))}}" alt="header" id="header_invoice_img" style="width: auto; margin: auto;  max-height: 150px;">
</div>
