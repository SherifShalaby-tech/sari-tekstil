<div class="row row_weight" style="margin: 0%">
    <table id="main">
        {{-- <th> --}}
        <div class="d-flex" style="gap: 10px">
            <button type="button"
                @if ((isset($hideBtn) && $hideBtn != 2) || (isset($key) && $key != 0)) style="display:none; margin-bottom: 0px;"
                @else style="margin-bottom: 0px" @endif
                class="plus add_row" value="Add New Row" data-index="{{ $index }}" id="rowButton"> <span
                    class="inner"></span>
                <i class="fa fa-plus"></i></button>

            <button type="button" class="print-ci-button" onclick="printRow(this)" id="rowButton"> <span
                    class="inner"></span>
                <i class="fa fa-print"></i></button>

            <button type="button"
                @if ((isset($hideBtn) && $hideBtn == 0) || (isset($key) && $key != 0)) style="display:inline;" @else style="display:none; " @endif
                class="remove-ci-button remove_row"> <span class="inner"></span>
                <i class="fa fa-close"></i></button>
        </div>
        {{-- </th> --}}
        <tr style="height: 60px">

            <th class="head" style="padding: 0 35px">
                <input type="hidden" name="pressing_request_id[]"
                    value="{{ isset($pressing_request->id) ? $pressing_request->id : '' }}" />
                <label for="filling_id" class="form-label"
                    style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.filling') }}*</label>
                <select name=filling_id[] class="form-control selectpicker" data-live-search="true"
                    style="display:inline !important">
                    @foreach ($fills as $id => $name)
                        <option value="{{ $id }}"
                            {{ isset($pressing_request->filling_id) && $pressing_request->filling_id == $id ? 'selected' : '' }}>
                            {{ $name }}</option>
                    @endforeach
                </select>
            </th>

            <th class="head" style="padding: 0 35px">
                <div class="form__group">
                    <input name="empty_weight[]" class="form__field"
                        value="{{ isset($pressing_request->empty_weight) ? $pressing_request->empty_weight : null }}"
                        type="number" placeholder="Emty Weight">
                    <label for="empty_weight" class="form__label"
                        style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.empty_weight') }}*</label>
                </div>
            </th>
            <th class="head" style="padding: 0 35px">
                <label for="screening_id" class="form-label"
                    style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.screening') }}*</label>
                <select name="screening_id[]" style="display:inline !important" class="form-control selectpicker"
                    data-live-search="true">

                    @foreach ($screening as $id => $name)
                        <option value="{{ $id }}"
                            {{ isset($pressing_request->screening_id) && $pressing_request->screening_id == $id ? 'selected' : '' }}>
                            {{ $name }}</option>
                    @endforeach
                </select>
            </th>
            <th class="head" style="padding: 0 35px">
                <label for="calibers" class="form-label"
                    style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.calibers') }}*</label>
                <select name="calibers[{{ $index }}][]" style="display:inline !important"
                    class="form-control selectpicker" data-live-search="true" multiple>
                    @foreach ($calibers as $id => $name)
                        <option value="{{ $id }}"
                            {{ isset($pressing_request->calibers) && in_array($id, $pressing_request->calibers) ? 'selected' : '' }}>
                            {{ $name }}</option>
                    @endforeach
                </select>
            </th>
        </tr>

        <tr style="height: 60px">
            <th class="head" style="padding: 0 35px">
                <div class="form__group">
                    <input name="requested_weight[]"class="form__field"
                        value="{{ isset($pressing_request->weight) ? $pressing_request->weight : null }}"
                        type="number" placeholder="Requested weight">
                    <label for="requested_weight" class="form__label"
                        style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.requested_weight') }}*</label>
                </div>
            </th>
            <th class="head" style="padding: 0 35px">
                <div class="form__group">

                    <input name="quantity[]"class="form__field"
                        value="{{ isset($pressing_request->quantity) ? $pressing_request->quantity : null }}"
                        type="number" placeholder="quantity">
                    <label for="quantity" class="form__label"
                        style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.quantity') }}*</label>
                </div>
            </th>
            <th class="head" style="padding: 0 35px">
                <label for="color_id" class="form-label"
                    style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.color') }}*</label>
                <select name="color_id[]" style="display:inline !important" class="form-control selectpicker"
                    data-live-search="true">
                    @foreach ($colors as $id => $name)
                        <option value="{{ $id }}"
                            {{ isset($pressing_request->color_id) && $pressing_request->color_id == $id ? 'selected' : null }}>
                            {{ $name }}</option>
                    @endforeach
                </select>
            </th>
            <th class="head" style="padding: 0 35px">
                <label for="destination" class="form-label"
                    style="{{ isset($hideBtn) ? 'display:none;' : '' }}">{{ __('lang.destination') }}*</label>
                <select name="destination[]" style="display:inline !important" class="form-control selectpicker"
                    data-live-search="true">
                    <option value="store"
                        {{ isset($pressing_request->destination) && $pressing_request->destination == 'store' ? 'selected' : null }}>
                        Store</option>
                    <option value="square"
                        {{ isset($pressing_request->destination) && $pressing_request->destination == 'square' ? 'selected' : null }}>
                        Square</option>
                    <option value="number"
                        {{ isset($pressing_request->destination) && $pressing_request->destination == 'number' ? 'selected' : null }}>
                        Number</option>
                </select>
            </th>
        </tr>

    </table>
</div>
