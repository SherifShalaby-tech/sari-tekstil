@php
$logo = App\Models\System::getProperty('logo');
@endphp
@if(!empty($logo))
<div class="row" style="text-align: center; width: 100%;">
    <img src="{{asset('uploads/'.$logo)}}" alt="footer" style="width: 100%;">
</div>
@endif