@extends('layouts.app')
@section('style')

<style>
    ul.alpha {list-style-type: lower-alpha;}
    ul.num {list-style-type: square;}
    li.inside-li, li.inside-li:hover{
        border-bottom: none !important;
    }
</style>
@endsection
@section('content')
    <h3 class="h3">Text Type Questions.</h3>
    <ul class="list-group list-group-flush num">
        @if($text_qs->count() > 0)
        @foreach($text_qs as $k => $q)
            <li class="list-group-item">{{ $k+1 }}:- Q:   <strong>{{ @$q->question }}</strong></li>
    @endforeach
            @else
            <li>No Question Inserted Yet!</li>
        @endif
    </ul>
    <h3 class="h3">Mcq Type Questions.</h3>
    <ul class="list-group list-group-flush ">
        @if($text_qs->count() > 0)

        @foreach($mcqs_qs as $k => $q)
            <li class="list-group-item inside-li"><strong>{{ $k+1 }}:- Q:  {{ @$q->question }}</strong></li>
            <li class="list-group list-group-flush" style="padding-left: 20px">
                <ul class="alpha">
                    @foreach($q->choices as $choice)
                        <li>{{ $choice->choice }} {!! $choice->is_correct ? "<i class='fa fa-check text-primary'></i>" : '' !!} </li>
                        @endforeach
                </ul>
            </li>
        @endforeach
            @else
            <li>No Question Inserted Yet!</li>
        @endif
    </ul>

@endsection
@section('script')

@endsection