@extends('master')

@section('contentTitle')
    <div class="wellcomeTitle">PETITIONS</div>
    <a href="/"><div class="menu">HOME</div></a>
@endsection



@section('content')    
    <div class="infoContent commonContent">
        <div class="sectionTop"><a href="../petitii">Lista petitii</a></div>
        <div>
            {!! Form::open() !!}
                <div class='form-group'>
                    {!! Form::label('title','Title') !!}
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>
                
                <div class='form-group'>
                    {!! Form::label('summary','Summary') !!}
                    {!! Form::textarea('summary',null,['class'=>'form-control summaryField']) !!}
                </div>
                
                <div class='form-group'>
                    {!! Form::label('description','Full description') !!}
                    {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                </div>
                
                <div class='form-group'>
                    {!! Form::submit('Register',['class'=>'form-control btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection