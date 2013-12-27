<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>User Profile</title>
        
        {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
        {{ HTML::style('css/main.css')}}
        {{ HTML::style('packages/dropzone/css/basic.css')}}
        
        
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        {{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
        {{ HTML::script('packages/dropzone/js/dropzone.js') }}
        
        {{ HTML::script('packages/blocksit/blocksit.js') }}
    </head>
    <body>
        
        <div class="navbar navbar-fixed-top navbar-default">
            
            <div class="container">
                <ul class="nav navbar-nav">
                    @if(!Auth::check())
                       <li>{{ HTML::link('user/'.Users::getRegisterRoute(), 'Register') }}</li>   
                       <li>{{ HTML::link('user/'.Users::getLoginRoute(), 'Login') }}</li>   
                    @else
                        <li>{{ HTML::link(Blocks::getWallRoute(), 'Home') }}</li>
                        
                        <li>
                            <a href="#" data-toggle="modal" data-target="#addBlockModal">Add Block</a>
                        </li>
                    
                        <li>{{ HTML::link('u/'.Users::getProfileRoute(), 'Profile') }}</li>
                        <li>{{ HTML::link(Users::getLogoutRoute(), 'logout') }}</li>
                    @endif 
                </ul>
            </div>
            
         </div>
        
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-danger" style="margin-top: 20px;">{{ Session::get('message') }}</div>
            <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
            @endif
            
            <div style="margin-top: 30px;">
                {{ $content }}
            </div>
        </div>
        
        {{ HTML::script('packages/nijibelle/shares/js/nijibelle.shares.plugin-0.1.js') }}
        
    </body>
</html>

{{\Blocks::getAddBlock(); }}

