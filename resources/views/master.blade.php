<!DOCTYPE html>
<html>
    <head>
        <title>e-Gov MEGACORP CITY</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        {!!HTML::style('css/css.css')!!}
    </head>
    <body>
        <div class="container">
            <div class="header">
                <a href="/">
                    <div class="headerTitle">
                        <div class="floatLeft tpoEgov">e-GOV</div>
                        <div class="floatLeft topCity">
                            <div class="cityName">MEGACORP CITY</div>
                            <div class="citySlogan">Independence - Security - Trust</div>
                        </div>
                        <div class="clearFix"></div>
                    </div>
                </a>
                @section('header')
                @show
            </div>
            
            <div class="content">
                @section('contentTitle')
                @show
                
                @section('content')
                @show
            </div>
            
            <div class="footer">
                @section('footer')
                @show
                <div class="footerContent">
                    <a href="/city">Your City</a> |
                    <a href="/contact">Contact</a> |
                    <a href="/help">Help</a>
                </div>
            </div>
        </div>
    </body>
</html>