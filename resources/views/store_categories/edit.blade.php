<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{__('lang.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => ['stores.update',$store->id],'method'=>'put','id'=>'opening-update-form' ]) !!}
                    @csrf
                    @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$store->id}}"/>
                    {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                    {!! Form::text('name', $store->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                    ]);
                    !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('branch', __( 'lang.branch' ) . ':*') !!}
                    {!! Form::select('branch_id', $branches,$store->branch_id , ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'id' => 'branch_id','required']) !!}
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
{{-- {!! JsValidator::formRequest('App\Http\Requests\UpdateOpeningRequest','#opening-update-form'); !!} --}}

