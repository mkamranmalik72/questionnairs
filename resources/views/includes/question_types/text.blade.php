<div class="text-ans">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-md-right">{{ __('Type') }}<span class="text-danger">*</span></label>
        <div class="col-sm-5">
            {{ Form::select('type', $types, isset($question->type) ? $question->type : 0, ['class' => $errors->has("type") ? "q-type form-control  is-invalid" : "q-type form-control",'id' => '']) }}
        </div>
        <div class="col-sm-3"><i class="text-danger fa fa-trash delete-question" title="Delete Question"></i></div>
    </div>

    {{--Text Type--}}
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-md-right">{{ __('Question') }}<span class="text-danger">*</span></label>
        <div class="col-sm-5">
            {{ Form::text('question', null, ['class' => $errors->has("question") ? "form-control  is-invalid" : "form-control" ,'placeholder' => 'Enter Question','id' => '']) }}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-md-right">{{ __('Answer') }}<span class="text-danger">*</span></label>
        <div class="col-sm-5">
            {{ Form::text('answer', null, ['class' => $errors->has("answer") ? "form-control  is-invalid" : "form-control" ,'placeholder' => 'Enter Question','id' => 'answer']) }}
        </div>
    </div>
</div>
<hr>
