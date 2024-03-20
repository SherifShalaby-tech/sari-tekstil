<div>
    <!-- Start Contentbar -->
    <div class="contentbar ">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    @include('cars.partials.filters', ['url' => 'planning-carts.index'])
                </div>
            </div>
        </div>
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                <div class="scrollable-div">
                    <div class=" table-responsive">
                        <table id="datatable-buttons-scroll" class="table table-striped table-bordered ">
                            {{-- <table id="datatable-buttons" class="display table table-striped table-bordered dataTable dtr-inline collapsed" role="grid" aria-describedby="default-datatable_info" >    --}}
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>@lang('lang.sku')</th>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.weight_empty')</th>
                                    <th>@lang('lang.recent_process')</th>
                                    {{-- <th>@lang('lang.recent_car_content')</th> --}}
                                    <th>@lang('lang.recent_place')</th>
                                    <th>@lang('lang.employee')</th>
                                    <th>@lang('lang.weight_product')</th>
                                    <th>@lang('lang.next_process') </th>
                                    <th>@lang('lang.next_place') </th>
                                    <th>@lang('lang.caliber')</th>
                                    <th>@lang('lang.next_employee')</th>
                                    <th></th>
                                    {{-- <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th> --}}
                                    {{-- <th>@lang('lang.action')</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $index => $car)
                                    <tr>

                                        <td>
                                            <input type="hidden" value="{{ $car->id }}" name="id" />
                                            {{ $index + 1 }}
                                        </td>
                                        <td>
                                            <div>
                                                {!! DNS1D::getBarcodeHTML($car->sku, 'C39') !!}
                                            </div>
                                        </td>
                                        <td>
                                            {!! Form::text('sku', $car->sku, [
                                                'class' => 'form-control sku',
                                                'style' => 'width:150px',
                                                'placeholder' => __('lang.sku'),
                                                'data-val' => $car->sku,
                                                !$disabled ? 'disabled' : '',
                                            ]) !!}
                                        </td>
                                        <td>{{ $car->name }}</td>
                                        <td>
                                            @if ($car->status == 0)
                                                <span class="text-danger">@lang('lang.empty')</span>
                                            @else
                                                <span class="text-primary">@lang('lang.occuppied')</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-between">
                                            {!! Form::number('weight_empty', @num_format($car->weight_empty), [
                                                'class' => 'form-control weight_empty',
                                                'placeholder' => '0.00',
                                                'style' => 'width:200px',
                                                'data-val' => $car->weight_empty,
                                                !$disabled ? 'disabled' : '',
                                            ]) !!}
                                            &nbsp;<span class="pt-2">Kg</span></td>
                                        <td>
                                            <select class="form-control selectpicker" data-live-search='true'
                                                style="width:150px" {{ !$disabled ? 'disabled' : '' }} name="process">
                                                <option value="">-</option>
                                                @foreach ($processes as $process)
                                                    <option value="{{ $process }}"
                                                        {{ !empty($car->process) && $car->process == $process ? 'selected' : '' }}>
                                                        {{ $process }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        {{-- <td>
                                    {!! Form::text('recent_car_content', !empty($car->recent_car_content)?$car->recent_car_content:null, ['class' => 'form-control recent_car_content','style'=>'width:200px', 'placeholder' => '-','data-val'=>$car->sku,!$disabled?'disabled':'']) !!}
                                </td> --}}
                                        <td>
                                            <select class="form-control selectpicker" data-live-search='true'
                                                style="width:150px" {{ !$disabled ? 'disabled' : '' }}
                                                name="recent_place">
                                                <option value="">-</option>
                                                @for ($i = 0; $i < count($places); $i++)
                                                    <option value="{{ $places[$i] }}"
                                                        {{ !empty($car->recent_place) && $car->recent_place == $places[$i] ? 'selected' : '' }}>
                                                        {{ $places[$i] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td>
                                            {!! Form::select('employee_id', $employees, $car->car_extras->pluck('employee_id')->toArray(), [
                                                'class' => 'selectpicker form-control employee_id',
                                                'style' => 'width:200px',
                                                'data-live-search' => 'true',
                                                !$disabled ? 'disabled' : '',
                                                'multiple',
                                            ]) !!}
                                        </td>
                                        <td class="d-flex justify-content-between">
                                            {!! Form::number('weight_product', @num_format($car->weight_product), [
                                                'class' => 'form-control weight_product',
                                                'style' => 'width:200px',
                                                'placeholder' => '0.00',
                                                'data-val' => $car->weight_product,
                                                !$disabled ? 'disabled' : '',
                                            ]) !!}
                                            &nbsp;<span class="pt-2">Kg</span></td>

                                        <td>
                                            <select class="form-control selectpicker" data-live-search='true'
                                                style="width:150px" {{ !$disabled ? 'disabled' : '' }}
                                                name="next_process">
                                                <option value="">-</option>
                                                @foreach ($processes as $process)
                                                    <option value="{{ $process }}"
                                                        {{ !empty($car->next_process) && $car->next_process == $process ? 'selected' : '' }}>
                                                        {{ $process }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control selectpicker" data-live-search='true'
                                                style="width:150px" {{ !$disabled ? 'disabled' : '' }}
                                                name="next_place">
                                                <option value="">-</option>
                                                @for ($i = 0; $i < count($places); $i++)
                                                    <option value="{{ $places[$i] }}"
                                                        {{ !empty($car->next_place) && $car->next_place == $places[$i] ? 'selected' : '' }}>
                                                        {{ $places[$i] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td>
                                            {!! Form::select('caliber_id', $calibars, $car->car_extras->pluck('caliber_id')->toArray(), [
                                                'class' => 'selectpicker form-control caliber_id',
                                                'style' => 'width:200px',
                                                'data-live-search' => 'true',
                                                'data-index' => $index,
                                                !$disabled ? 'disabled' : '',
                                                'multiple',
                                            ]) !!}
                                        </td>
                                        <td>
                                            {!! Form::select('next_employee_id', $employees, $car->car_extras->pluck('next_employee_id')->toArray(), [
                                                'class' => 'selectpicker form-control next_employee_id',
                                                'style' => 'width:200px',
                                                'data-live-search' => 'true',
                                                'data-index' => $index,
                                                !$disabled ? 'disabled' : '',
                                                'multiple',
                                            ]) !!}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary change_plan"
                                                data-id="{{ $car->id }}">@lang('lang.change_plan')</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="view_modal no-print">
                        </div>
                    </div>
                </div>
            </div>
            @if ($disabled && !empty($cars))
                <div class="col-lg-12 col-xl-12">
                    <button id="save" class="btn btn-primary">{{ __('lang.save') }}</button>
                    <button id="save-print" data-print="1"
                        class="btn btn-danger">{{ __('lang.save_and_print') }}</button>
                </div>
            @endif
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
</div>
