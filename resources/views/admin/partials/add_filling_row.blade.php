
<div class="row row_weight" style="margin: 0%">
    <table id="main">
        {{-- <th> --}}
            <button type="button" @if((isset($hideBtn) && $hideBtn != 2)|| (isset($key) && $key!=0))
            style="display:none; margin-bottom: 10px;"
            @else style="margin-bottom: 10px;"  @endif 
                class="btn btn-primary btn-sm ml-2 add_row" value="Add New Row" onclick="addRow();" data-index="{{ $index }}" id="rowButton"><i class="fa fa-plus"></i></button>
        {{-- </th> --}}
        <th class="head">
            <select  name=filling_id[] class="form-control selectpicker" data-live-search="true" style="display:inline !important">
            @foreach ($fills as $id => $name)
                <option value="{{ $id }}" {{(isset($filling_request->filling_id)&&$filling_request->filling_id==$id?'selected':'')}}>{{ $name }}</option>
            @endforeach
          </select></th>
          <th class="head">
            <input type="hidden" name="filling_request_id[]" value="{{isset($filling_request->id)?$filling_request->id:''}}"/>
          </th>
        <th class="head">
            <input name="empty_weight[]" value="{{isset($filling_request->empty_weight)?$filling_request->empty_weight:null}}" class="form-control" type="number" placeholder="Emty Weight"></th>
        <th class="head">
            <select  name=screening_id[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
            @foreach ($screening as $id => $name)
                <option value="{{ $id }}" {{(isset($filling_request->screening_id)&&$filling_request->screening_id==$id?'selected':'')}}>{{ $name }}</option>
            @endforeach
            </select>
        </th>
        <th class="head"><select  name="calibers[{{ $index }}][]" style="display:inline !important" class="form-control selectpicker" data-live-search="true" multiple>
        @foreach ($calibers as $id => $name)
            <option value="{{ $id }}" {{(isset($filling_request->calibers)&&in_array($id, $filling_request->calibers)?'selected':'')}}>{{ $name }}</option>
        @endforeach
        </select></th>
        <th class="head"><select  name=employee_id[] style="display:inline !important" class="form-control selectpicker" data-live-search="true">
            <option value="">Select</option>
            @foreach ($employees as $id => $name)
                <option value="{{ $id }}" {{(isset($filling_request->employee_id)&&$filling_request->employee_id==$id?'selected':'')}}>{{ $name }}</option>
            @endforeach
            </select>
        </th>
        <th class="head"><input name="requested_weight[]"class="form-control" value="{{(isset($filling_request->requested_weight)?$filling_request->requested_weight:null)}}" type="number" placeholder="Requested weight"></th>
        <th class="head"><input name="quantity[]"class="form-control" value="{{(isset($filling_request->quantity)?$filling_request->quantity:null)}}" type="number" placeholder="quantity"></th>
        <th class="head"><select  name=color_id[]  style="display:inline !important" class="form-control selectpicker" data-live-search="true">
            @foreach ($colors as $id => $name)
                <option value="{{ $id }}" {{(isset($filling_request->color_id)&&$filling_request->color_id==$id?'selected':null)}}>{{ $name }}</option>
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
                <button type="button" @if((isset($hideBtn) && $hideBtn == 0)|| (isset($key) && $key!=0))  style="display:inline;" @else style="display:none; "@endif 
                    class="btn btn-danger btn-sm ml-2 remove_row"><i class="fa fa-close"></i></button>
           </th>
    </table>
</div>
