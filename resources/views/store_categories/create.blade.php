@php
     $branches = App\Models\Branch::pluck('name', 'id');
@endphp
<!-- Modal -->
<div class="modal fade" id="createStoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('lang.add')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => 'storecategories.store', 'method' => 'post', 'files' => true,'id' =>'branch-form' ]) !!}
            <div class="modal-body">
                <div class="form-group">

                    {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                    ]);
                    !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">

                    {!! Form::label('branch', __( 'lang.branch' ) . ':*') !!}
                    {!! Form::select('branch_id', $branches, false, ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'id' => 'branch_id','required']) !!}
                    @error('branch_id')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">

                   {!! Form::label('store', __( 'lang.store' ) . ':*') !!}
                   {!! Form::select('store_id', $stores, false, ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'id' => 'store_id','required']) !!}
                   @error('store_id')
                       <label class="text-danger error-msg">{{ $message }}</label>
                   @enderror
               </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
                <button  id="create-nationality-btn" class="btn btn-primary">{{__('lang.save')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Triggered when the branch dropdown value changes
        $('#branch_id').change(function () {
            // Get the selected branch ID
            var branchId = $(this).val();

            // Make an AJAX request to get the stores based on the selected branch
            $.ajax({
                url: '/getStores/' + branchId, // Replace with the actual route for fetching stores
                type: 'GET',
                success: function (data) {
                    // Clear existing options in the store dropdown
                    $('#store_id').empty();
                    console.log(data);
                    // Add the new options based on the received data
                    $.each(data, function (key, value) {
                        $('#store_id').append('<option value="' + key + '">' + value + '</option>');
                    });

                    // Refresh the SelectPicker to reflect the changes
                    $('#store_id').selectpicker('refresh');
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

{{-- {!! JsValidator::formRequest('App\Http\Requests\StoreOpeningRequest','#opening-form'); !!} --}}
