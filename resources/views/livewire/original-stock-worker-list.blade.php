<div>
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-3 col-xl-3">
            <input type="text" wire:model="search" placeholder="Search items..." class="form-control">
        </div>
    </div>
    <!-- Start row -->
    {!! Form::open([
        'route' => 'original-store-worker.store',
        'method' => 'post',
        'files' => true,
        'id' => 'recieve-stock-form',
    ]) !!}
    <div class="row pt-3">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr class="table-light">
                                <th scope="col">@lang('lang.sku')</th>
                                <th scope="col">@lang('lang.number')</th>
                                <th scope="col">@lang('lang.type')</th>
                                <th scope="col">@lang('lang.weight')</th>
                                <th scope="col">@lang('lang.recent_content')</th>
                                <th scope="col">@lang('lang.color')</th>
                                <th scope="col">@lang('lang.recent_weight')</th>
                                <th scope="col">@lang('lang.process')</th>
                                <th scope="col">@lang('lang.recent_color')</th>
                                <th scope="col">@lang('lang.recieve')</th>
                                <th scope="col">@lang('lang.print')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr class="{{ in_array($item->id, $red_items) ? 'table-danger' : 'table-default' }}">
                                    <th scope="row">Danger</th>
                                    <td>{{ $item->shipment_number }}</td>
                                    <td>{{ $item->type->name }}</td>
                                    <td>{{ @num_format($item->total_weight) }}</td>
                                    <td>Cell</td>
                                    <td>
                                        {{-- {{ $item->color->name }} --}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="stock[{{ $index }}][original_stock_id]"
                                            value="{{ $item->id }}" />
                                        {!! Form::number('stock[{{ $index }}][recent_weight]', null, [
                                            'class' => 'form-control recent_weight',
                                            'placeholder' => '0.00',
                                            'style' => 'width:200px',
                                        ]) !!}
                                    </td>
                                    </td>
                                    <td>
                                        {!! Form::select('stock[{{ $index }}][process]', $processes, null, [
                                            'class' => 'selectpicker form-control process',
                                            'style' => 'width:200px',
                                            'data-live-search' => 'true',
                                            'placeholder' => '-',
                                        ]) !!}
                                    </td>
                                    <td>
                                        {!! Form::select('stock[{{ $index }}][color_id]', $colors, null, [
                                            'class' => 'selectpicker form-control color',
                                            'style' => 'width:200px',
                                            'data-live-search' => 'true',
                                            'placeholder' => '-',
                                        ]) !!}
                                    </td>
                                    <td class="recieve">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input recive_stock"
                                                id="recive_stock{{ $item->id }}"
                                                name="stock[{{ $index }}][recive_stock]">
                                            <label class="custom-control-label"
                                                for="recive_stock{{ $item->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="btn btn-info"><i class="fa fa-print"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Start col -->
    <button type="submit" class="px-3 py-2 submit-button">
        <span class="transition"></span>
        <span class="gradient"></span>
        <span class="label">@lang('lang.save')</span>
    </button>
    {!! Form::close() !!}
</div>
