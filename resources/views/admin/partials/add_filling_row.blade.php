@php
    $index = 1;
@endphp
<div class="row row_weight" style="margin: 0%">
    <table id="main">
        {{-- <th> --}}
            <button type="button" @if(isset($hideBtn) && $hideBtn != 2)
            style="display:none; margin-bottom: 10px;"
            @else style="margin-bottom: 10px"  @endif 
                class="btn btn-primary btn-sm ml-2 add_row" value="Add New Row" onclick="addRow();" data-index="{{ $index }}" id="rowButton"><i class="fa fa-plus"></i></button>
        {{-- </th> --}}
        <th class="head"><select  name=filling_id[] class="form-control selectpicker" data-live-search="true" style="display:inline !important">
            @foreach ($fills as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </select></th>
        <th class="head"><input name="empty_weight[]" class="form-control" type="number" placeholder="Emty Weight"></th>
        <th class="head"><select  name=screening_id[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
            @foreach ($screening as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </select></th>
        <th class="head"><select  name="calibers[{{ $index }}][]" style="display:inline !important" class="form-control selectpicker" data-live-search="true" multiple>
        @foreach ($calibers as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
        </select></th>
        <th class="head"><select  name=employee_id[] style="display:inline !important" class="form-control selectpicker" data-live-search="true">
            <option value="">Select</option>
            @foreach ($employees as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
            </select></th>
        <th class="head"><input name="requested_weight[]"class="form-control" type="number" placeholder="Requested weight"></th>
        <th class="head"><input name="quantity[]"class="form-control" type="number" placeholder="quntity"></th>
        <th class="head"><select  name=color_id[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
            @foreach ($colors as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
            </select></th>
            <th class="head"><select  name=destinations[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
                    <option value="store">Store</option>
                    <option value="square">Square</option>
                    <option value="number">Number</option>
                </select></th>
            <th>
                <button type="button" 
                class="btn btn-primary btn-sm ml-2"  onclick="printRow(this)" id="rowButton"><i class="fa fa-print"></i></button>
            </th>
            <th>
                <button type="button" @if(isset($hideBtn) && $hideBtn == 0)  style="display:inline;" @else style="display:none; "@endif 
                    class="btn btn-danger btn-sm ml-2 remove_row"><i class="fa fa-close"></i></button>
           </th>
    </table>
</div>