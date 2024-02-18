<div>
    <!-- Start Contentbar -->
    <div class="contentbar ">
        {{-- <div class="row">
           <div class="col-lg-12">
               <div class="container-fluid">
                   @include('cars.partials.filters',['url'=>'planning-carts.index'])
               </div>
           </div>
       </div> --}}
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
                                    {{-- <th></th> --}}
                                    <th>@lang('lang.sku')</th>
                                    <th>@lang('lang.name')</th>
                                    {{-- <th>@lang('lang.status')</th> --}}
                                    <th>@lang('lang.weight_empty')</th>
                                    {{-- <th>@lang('lang.recent_process')</th> --}}
                                    <th>@lang('lang.recent_car_content')</th>
                                    <th>@lang('lang.recent_place')</th>
                                    <th>@lang('lang.employee')</th>
                                    <th>@lang('lang.weight_product')</th>
                                    {{-- <th>@lang('lang.next_process') </th> --}}
                                    {{-- <th>@lang('lang.next_place') </th> --}}
                                    <th>@lang('lang.caliber')</th>
                                    <th>@lang('lang.color')</th>
                                    <th>@lang('lang.bale_weight')</th>
                                    <th>@lang('lang.number_of_bales')</th>
                                    <th>@lang('lang.squeeze_bales_count')</th>
                                    <th>@lang('lang.next_place')</th>
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
                                            {{ $car->sku }}
                                        </td>
                                        <td>{{ $car->name }}</td>
                                        <td>
                                            {{ @num_format($car->weight_empty ?? 0) }}
                                            &nbsp;Kg
                                        </td>
                                        {{-- <td>{{$car->process??''}}</td> --}}

                                        <td>{{ $car->recent_car_content ?? '-' }}</td>
                                        <td>
                                            {{ $car->recent_place ?? '-' }}
                                        </td>
                                        <td>
                                            @php
                                                $employeesString = implode(', ', \App\Models\Employee::whereIn('id', $car->car_extras->pluck('employee_id')->toArray())->pluck('name')->toArray());
                                            @endphp
                                            {{ $employeesString }}<br>
                                        </td>

                                        <td class="d-flex justify-content-between">
                                            {!! @num_format($car->weight_product) !!}
                                            &nbsp;Kg

                                            {{ $this->updateWeightProduct($index, $car->weight_product, $car->id, $car->next_place) }}
                                        </td>
                                        <td>
                                            {{-- {!! Form::select('caliber_id', $calibars, $car->car_extras->pluck('caliber_id')->toArray(), [
                                                'class' => 'selectpicker form-control caliber_id',
                                                'style' => 'width:200px',
                                                'data-live-search' => 'true',
                                                'data-index' => $index,
                                                'multiple',
                                            ]) !!} --}}

                                            @php
                                                $calibarsString = implode(', ', $car->car_extras->pluck('caliber_id')->toArray());
                                            @endphp
                                            {{ $calibarsString }}<br>
                                        </td>
                                        <td>{{ $car->color->name ?? '' }}</td>

                                        <td><input type="text" wire:model="rows.{{ $index }}.bale_weight"
                                                wire:change="updateBaleWeight({{ $index }}, $event.target.value)">
                                        </td>
                                        <td><input type="text" wire:model="rows.{{ $index }}.num_of_bales"
                                                wire:change="updateNumBales({{ $index }}, $event.target.value)">
                                        </td>
                                        {{-- <td>{{ isset($this->rows[$index]['num_of_bales']) ? @number_format($this->rows[$index]['num_of_bales'], 3) : '' }} --}}
                                        </td>
                                        <td>{{ isset($this->rows[$index]['real_num_of_bales']) ? $this->rows[$index]['real_num_of_bales'] : '' }}
                                        </td>
                                        <td>
                                            {{-- {{ array_search($car->next_place, $places) }} --}}
                                            {!! Form::select('rows['. $index .'].next_place', $places, array_search($car->next_place, $places), [
                                                'class' => 'form-control next_place',
                                                'wire:model' => "rows.$index.next_place", // Use double quotes for string interpolation
                                                'wire:input' => "updateNextPlace($index, \$event.target.value)", // No need for curly braces here
                                                'style' => 'width:200px',
                                                // 'data-live-search' => 'true',
                                                // 'data-index' => $index,
                                            ]) !!}
                                        </td>
                                        <td>
                                            <button class="btn btn-default text-danger"
                                                wire:click="autommaticSqueeze({{ $index }})"
                                                title="{{ __('lang.squeeze') }}">
                                                <h4 class="text-danger" title="{{ __('lang.squeeze') }}">
                                                    <i class="fa fa-stop-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
</div>
