{{ Form::model($question, ['url' => $action,'method' => $method,'class' => 'form-horizontal','files' => true,'id' => 'question-form']) }}

<input type="hidden" value="{{ @$questionnair_id }}" name="questionnair_id" id="questionnair_id">
<div class="parent-container">
@include('includes.question_types.text')
</div>
{{ Form::close() }}
<div class="row">
    <div class="col-sm-2 ">
        <button type="button" id="submit_form" class="btn btn-success">Save Question</button>
    </div>
    <div class="col-sm-2 ">
        <button type="button" class="btn btn-outline-success" id="add_question">Add Question</button>
    </div>
</div>
