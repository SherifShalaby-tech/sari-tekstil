<!-- Modal -->
<div class="edit-overlay" onclick="closeEditModal($type->id)"></div>
<div id="form-panel{{ $job->id }}" class="form-panel off">

    <div class="modal-header">
        <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="closeEditModal({{ $job->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => ['jobs.update', $job->id], 'method' => 'put', 'id' => 'job-update-form']) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form__group w-50 m-auto">
            <input type="hidden" name="id" value="{{ $job->id }}" />
            {!! Form::text('title', $job->title, [
                'class' => 'form__field',
                'style' => 'padding: 9px 0 0',
                'placeholder' => __('lang.name'),
                'required',
            ]) !!}
            {!! Form::label('name', __('lang.name') . '*', [
                'class' => 'form__label',
            ]) !!}
            @error('title')
                <label class="text-danger error-msg">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="px-3 py-2 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <div class="px-3 py-2 delete-button" onclick="closeEditModal({{ $job->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>
{!! JsValidator::formRequest('App\Http\Requests\UpdateJobRequest', '#job-update-form') !!}
