<!DOCTYPE html>
<html>
    <head>
        <title>e-Gov MEGACORP CITY</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    </head>

    <body>
        {!! Form::open(['url'=>'/auth/register']) !!}
        <div style='width:500px;margin:auto'>
            <h1>Register</h1>
            <div class="form-group">
                {!! Form::label('name','Name') !!}
                {!! Form::text('name',null,['class'=>'form-control', 'id'=>'name']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('email','Email') !!}
                {!! Form::email('email',null,['class'=>'form-control', 'id'=>'email']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('password','Password - min 6 characters') !!}
                {!! Form::password('password',['class'=>'form-control', 'id'=>'password']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('password_confirmation','Confirm Password') !!}
                {!! Form::password('password_confirmation',['class'=>'form-control', 'id'=>'password']) !!}
            </div>

            <div class='form-group'>
                {!! Form::submit('Register',['class'=>'form-control btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </body>
</html>