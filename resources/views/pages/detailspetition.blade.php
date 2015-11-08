@extends('master')

@section('contentTitle')
    <div class="wellcomeTitle">{{$petition['title']}}</div>
    <div class="menu">
        <a href="/">HOME</a> |
        <a href="/petitii">Petitions list</a>
    </div>
@endsection



@section('content')    
    <div class="infoContent commonContent">
        <div>
            <div class='form-group'>
                Started by <b>{{$petition['author']}} | Votes in support: {{$petition['votesYes']}} --- Votes against: {{$petition['votesNo']}}</b>
            </div>
            <div class='form-group'>
                {{$petition['description']}}
            </div>
        </div>
        <hr />
        <div>
            <div class="floatLeft" style="width:499px;text-align:center">
                <div style="width:90%; margin:auto">
                    {!! Form::open(['url' => '/petitions/vote/for/'.$petition['id']]) !!}
                        <div class='form-group'>
                            {!! Form::submit('Vote IN SUPPORT',['class'=>'form-control btn btn-primary']) !!}
                        </div>  
                    {!! Form::close() !!}
                </div>
            </div>
            
            <div class="floatLeft" style="width:499px;text-align:center">
                <div style="width:90%; margin:auto">
                    {!! Form::open(['url' => '/petitions/vote/against/'.$petition['id']]) !!}
                        <div class='form-group'>
                            {!! Form::submit('Vote AGAINST',['class'=>'form-control btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="clearFix"></div>
        </div>
    </div>
@endsection