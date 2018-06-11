@extends('layouts.app')
@section('content')
    <div class="form-container">
    {{ Form::model($questionnair, ['url' => $action,'method' => $method,'class' => 'form-horizontal','files' => true,'id' => 'questionnair-form']) }}
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-md-right">{{ __('Questionnair Name') }}<span
                    class="text-danger">*</span></label>
        <div class="col-sm-6">
            {{ Form::text('name', null, ['class' => $errors->has("name") ? "name form-control  is-invalid" : "name form-control" ,'placeholder' => 'Enter Questionnair Name','id' => 'name']) }}
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-md-right">{{ __('Duration') }}<span
                    class="text-danger">*</span></label>
        <div class="col-sm-3">
            {{ Form::number('duration', null, ['class' => $errors->has("duration") ? "duration form-control  is-invalid" : "duration form-control",'placeholder' => 'Enter Duration','id' => 'duration','min' => 0]) }}
            @if ($errors->has('duration'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
            @endif
        </div>
        <div class="col-sm-3">
            {{ Form::select('duration_type', $duration_types, @$questionnair->duration_type, ['class' => $errors->has("duration_type") ? "duration_type form-control  is-invalid" : "duration_type form-control",'id' => 'duration_type']) }}
            @if ($errors->has('duration_type'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('duration_type') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-md-right">{{ __('Resumeable') }}<span
                    class="text-danger">*</span></label>
        <div class="col-sm-6">
            {{--                {{ Form::radio('resumeable', $questionnair-> , true, ['class' => 'field']) }}--}}
            Yes {{ Form::radio('resumeable', 1, 1, ['class' => $errors->has("resumeable") ? "is-invalid field" : "field" ]) }}
            No {{ Form::radio('resumeable', 0, @$questionnair->resumeable, ['class' => $errors->has("resumeable") ? "is-invalid field" : "field" ]) }}
            @if ($errors->has('resumeable'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('resumeable') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="offset-3 col-sm-9 ">
            <button type="submit" class="btn btn-success">{{ $btn }}</button>
        </div>
    </div>


    {{ Form::close() }}
    </div>
@endsection
@section('script')
    <script>
        function remove_is_invalid(key) {
            $('.' + key).removeClass('is-invalid');
        }
        $(document).on('submit', '#questionnair-form', function (e) {
            e.preventDefault();
            // $("#connect_to_").text("Connectiong...");
            params = $('#questionnair-form').serialize();
            var url = '{{ route('questionnair.store') }}';
            var successCallback = function (res) {
                res = jQuery.parseJSON(res);
                if (parseInt(res.status) === 200) {
                    window.location.href = '/questionnair/'+res.questionnair_id+'/question/create';
                } else if (parseInt(res.status) === 400) {
                    $('.invalid-feedback').remove();
                    $('#questionnair-form input').removeClass('is-invalid field');
                    $.each(res.errors, function (key, value) {
                        console.log(key + '===' + value);
                        $('.' + key).addClass('is-invalid field');
                        $('.' + key).after('<span class="invalid-feedback"> ' +
                            '<strong>' + value + '</strong> </span>')
                    });
                }
            };
            ajx(url, 'post', params, successCallback, 'html');
        });
    </script>
@endsection