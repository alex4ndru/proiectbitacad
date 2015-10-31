@extends('master')

@section('contentTitle')
    <div class="wellcomeTitle">NO SUCH CITIZEN REGISTERED !</div>
    <div class="menu">
        <a href="/">HOME</a> |
        <a href="/petitii/new">New Petition</a>
    </div>
@endsection



@section('content')    
    <div class="infoContent commonContent" style='text-align:center; font-size:24px'>
        <div>
        The access code dosen't belong to any registered citizen !<br />
        Please try again !<br />
        </div>
        <hr />
        <div>
        If you are not registered yet, contact the Citizen Processing Agency at once !
        </div>
    </div>
@endsection