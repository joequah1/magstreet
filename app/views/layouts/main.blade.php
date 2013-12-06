<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>User Profile</title>
        
        {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
        {{ HTML::style('css/main.css')}}
    </head>
    <body>
        
        <div class="navbar navbar-fixed-top navbar-default">
            
            <div class="container">
                <ul class="nav navbar-nav">
                    @if(!Auth::check())
                       <li>{{ HTML::link('user/register', 'Register') }}</li>   
                       <li>{{ HTML::link('user/login', 'Login') }}</li>   
                    @else
                       <li>{{ HTML::link('user/logout', 'logout') }}</li>
                    @endif 
                </ul>
            </div>
            
         </div>
        
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-danger" style="margin-top: 20px;">{{ Session::get('message') }}</div>
            @endif
            
            {{ $content }}
        </div>
    </body>
</html>