@extends('master')

@section('contentTitle')
    <div class="wellcomeTitle">PETITIONS</div>
    <a href="/"><div class="menu">HOME</div></a>
@endsection



@section('content')    
    <div class="infoContent commonContent">
        <div class="sectionTop"><a href="petitii/new">Petitie noua</a></div>
        <div class='petitionsList list-group'>
            @foreach ($petitions as $currentPetition)
                <a href="/petitions/{{$currentPetition['id']}}">
                    <div class="elMain list-group-item">
                        <div class="elTitle">{{$currentPetition['title']}} | Votes in support: {{$currentPetition['votesYes']}} --- Votes against: {{$currentPetition['votesNo']}}</div>
                        <div class="elSummary">{{$currentPetition['summary']}}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection