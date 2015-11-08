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
            <div class='form-group'>
                <em>Please <b><a href="/auth/login">Login</a></b> to vote !</em>
            </div>
        </div>
    </div>
@endsection