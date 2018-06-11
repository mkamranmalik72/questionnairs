@extends('layouts.app')
@section('content')
    @include('includes.question-form')
    <div id="type_0" class="hidden">
        @include('includes.question_types.text')
        <hr>
    </div>
    <div id="type_1" class="hidden">
        <div class="mul-sin-ans">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Type') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::select('type', $types, isset($question->type) ? $question->type : 1, ['class' => $errors->has("type") ? "q-type form-control  is-invalid" : "q-type form-control",'id' => '']) }}
                </div>
                <div class="col-sm-3"><i class="text-danger fa fa-trash delete-question" title="Delete Question"></i></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Question') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('question', null, ['class' => $errors->has("question") ? "form-control  is-invalid" : "form-control" ,'placeholder' => 'Enter Question','id' => '']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Choice') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('choice[]', null, ['class' => "form-control" ,'placeholder' => 'Enter Choice','id' => '']) }}
                </div>
                <div class="col-sm-2">
                    {{--                {{ Form::radio('is_correct', $questionnair-> , true, ['class' => 'field']) }}--}}
                    {{ Form::radio('is_correct', '0', '0', ['class' => "field" ]) }}  Correct?
                </div>
                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Choice') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('choice[]', null, ['class' => "form-control" ,'placeholder' => 'Enter Choice','id' => '']) }}
                </div>
                <div class="col-sm-2">
                    {{--                {{ Form::radio('is_correct', $questionnair-> , true, ['class' => 'field']) }}--}}
                    {{ Form::radio('is_correct', '1', '1', ['class' => "field" ]) }}  Correct?
                </div>
                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Choice') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('choice[]', null, ['class' => "form-control" ,'placeholder' => 'Enter Choice','id' => '']) }}
                </div>
                <div class="col-sm-2">
                    {{--                {{ Form::radio('is_correct', $questionnair-> , true, ['class' => 'field']) }}--}}
                    {{ Form::radio('is_correct', '2', '2', ['class' => "field" ]) }}  Correct?
                </div>
                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>
            </div>
            <div class="row">
                <div class="offset-3 col-sm-9 ">
                    <button type="button" class="btn btn-outline-success add-choice-a">Add Choice</button>
                </div>
            </div>
        </div>
        <hr>
        </div>
    <div id="type_2" class="hidden">
        <div class="mul-mul-ans">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Type') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::select('type', $types, isset($question->type) ? $question->type : 2, ['class' => $errors->has("type") ? "q-type form-control  is-invalid" : "q-type form-control",'id' => '']) }}
                </div>
                <div class="col-sm-3"><i class="text-danger fa fa-trash delete-question" title="Delete Question"></i></div>

            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Question') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('question', null, ['class' => "form-control" ,'placeholder' => 'Enter Question','id' => '']) }}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Choice') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('choice[]', null, ['class' => "form-control" ,'placeholder' => 'Enter Choice','id' => '']) }}
                </div>
                <div class="col-sm-2">
                    {{--                {{ Form::radio('is_correct', $questionnair-> , true, ['class' => 'field']) }}--}}
                    {{ Form::checkbox('is_correct[]', 0, 0, ['class' => "field" ]) }}  Correct?
                </div>
                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Choice') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('choice[]', null, ['class' => "form-control" ,'placeholder' => 'Enter Choice','id' => '']) }}
                </div>
                <div class="col-sm-2">
                    {{--                {{ Form::checkbox('is_correct[]', $questionnair-> , true, ['class' => 'field']) }}--}}
                    {{ Form::checkbox('is_correct[]', 1, 1, ['class' => "field" ]) }}  Correct?
                </div>
                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-md-right">{{ __('Choice') }}<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    {{ Form::text('choice[]', null, ['class' => "form-control" ,'placeholder' => 'Enter Choice','id' => '']) }}
                </div>
                <div class="col-sm-2">
                    {{--                {{ Form::checkbox('is_correct[]', $questionnair-> , true, ['class' => 'field']) }}--}}
                    {{ Form::checkbox('is_correct[]', 2, 2, ['class' => "field" ]) }}  Correct?
                </div>
                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>
            </div>

            <div class="row">
                <div class="offset-3 col-sm-9 ">
                    <button type="button" class="btn btn-outline-success add-choice-b" data-value="2">Add Choice</button>
                </div>
            </div>
        </div>
        <hr>
        </div>
    <div id="messages"></div>

@endsection
@section('script')
    <script src="{{ URL::asset('js/jquery_validate/jquery.validate.js') }}"></script>

<script>
    $(document).ready(function() {

        $('#question-form').validate({ // initialize plugin
            // rules & options,
            rules: {
                type: {
                    required: true
                },
                question: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                type: {
                    required: "<li>Please select a type.</li>",
                },
                question: {
                    minlength: "<li>Your name is not long enough.</li>"
                }
            },
            submitHandler: function (form) {
                // your ajax would go here
                alert('simulated ajax submit');
                return false;  // blocks regular submit since you have ajax
            }
        });
    });
    $(document).on('click','#add_question',function (e) {
        e.preventDefault();
        $('#question-form').append('<div class="parent-container">' + $('#type_0').html() + '</div>');
    });

    $(document).on('click','.add-choice-a',function (e) {
        $(this).closest('.row').before('<div class="form-group row">\n' +
            '                <label class="col-sm-3 col-form-label text-md-right">{{ __("Choice") }}<span class="text-danger">*</span></label>\n' +
            '                <div class="col-sm-5">\n' +
            '                    {{ Form::text("choice[]", null, ["class" => "form-control" ,"placeholder" => "Enter Choice","id" => ""]) }}\n' +
            '                </div>\n' +
            '                <div class="col-sm-2">\n' +
            '                    {{ Form::radio("is_correct", "2", "2", ["class" => "field" ]) }}  Correct?\n' +
            '                </div>\n' +
            '                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>\n' +
            '            </div>');
    });
    $(document).on('click','.add-choice-b',function (e) {
        var value = $(this).data('value');
        value = value + 1;
        var num = $(this).data("value") + 1;
        $(this).data('value', num);

        $(this).closest('.row').before('<div class="form-group row">\n' +
            '                <label class="col-sm-3 col-form-label text-md-right">Choice<span class="text-danger">*</span></label>\n' +
            '                <div class="col-sm-5">\n' +
            '                    <input class="form-control" placeholder="Enter Question" id="" name="choice[]" type="text">\n' +
            '                </div>\n' +
            '                <div class="col-sm-2">\n' +
            '                    \n' +
            '                    <input class="field" name="is_correct[]" type="checkbox" value="'+value+'">  Correct?\n' +
            '                </div>\n' +
            '                <div class="col-sm-1"><a class="btn btn-danger text-white delete-choice">Delete Choice</a></div>\n' +
            '            </div>');
    });
    $(document).on('click','.delete-choice',function (e) {
        $(this).closest('.form-group').remove();
    });
    $(document).on('click','.delete-question',function (e) {
        $(this).closest('.parent-container').remove();
    });


    $(document).on('change','.q-type', function() {
        qtype = this.value;
        el = this;
        $(this).closest('.parent-container').html($('#type_' + qtype).html())
    });

    $(document).on('click','#submit_form',function (e) {
        e.preventDefault();

        var dd = $.each($("body .parent-container"), function( key, value ) {
            element = $(this).find(':input');
            params = element.serialize()+'&questionnair_id=' + $('#questionnair_id').val();
            console.log(params);
            var url = '{{ route('question.store') }}';
            var successCallback = function (res) {
                res = jQuery.parseJSON(res);
                console.log(res);
                if (res.status === 200) {
                } else if (res.status === 400) {

                }
            };
            var failCallback = function (res) {

            };
            ajx(url, 'post', params, successCallback, failCallback, 'html');
        });
        window.location.href = '{{ route('questionnair.index') }}'
    })

</script>
@endsection