<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>User Profile</title>
        
        {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
        {{ HTML::style('css/main.css')}}
        {{ HTML::style('packages/dropzone/css/basic.css')}}
        {{ HTML::style('packages/image-picker/css/image-picker.css') }}
        
        
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        {{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
        {{ HTML::script('packages/dropzone/js/dropzone.js') }}
        
        {{ HTML::script('packages/blocksit/js/blocksit.js') }}
        {{ HTML::script('packages/image-picker/js/image-picker.js') }}
        {{ HTML::script('packages/expander/jquery.expander.js') }}
        {{ HTML::script('packages/waitforimages/js/jquery.waitforimages.js') }}
        {{ HTML::script('packages/cutetime/js/jquery.cuteTime.js') }}
    </head>
    <body>
        
        <div class="navbar navbar-fixed-top navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                
                    <div class="navbar-brand">
                    {{ HTML::link(Blocks::getWallRoute(), '', array('class'=>'magstreetlogo magstreetlogo-magstreet')) }}
                    </div>
                </div>
                
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @if(!Auth::check())
                       <li>{{ HTML::link('user/'.Users::getRegisterRoute(), 'Register') }}</li>   
                       <li>{{ HTML::link('user/'.Users::getLoginRoute(), 'Login') }}</li>   
                        @else
                        <li>
                            <a href="#" data-toggle="modal" data-target="#addBlockModal">
                                <span class="magstreeticon magstreeticon-add"></span>
                            </a>
                        </li>
                    
                        <li>
                            <a href="<?php echo URL::to(Friends::getFriendsListRoute(Auth::user()->id));?>"><span class="magstreeticon magstreeticon-profile"></span></a>
                        </li>
                        
                            
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="media navbar-profile">
                                    <div class="media-object pull-left">
                                        
                                        <!-- Update the model in root model folder-->
                                        <img src="<?php echo Auth::user()->profileImage[0]->path?>"/>
                                        
                                    </div>
                                        
                                    <div class="media-body vertical-middle">
                                        {{Auth::user()->firstname." ".Auth::user()->lastname}}
                                    </div>
                                
                                </div>
                            </a>
                            
                            <ul class="dropdown-menu">
                                <li>{{ HTML::link(Users::getProfileRoute(), 'Profile') }}</li>
                                <li>{{ HTML::link(Users::getLogoutRoute(), 'logout') }}</li>
                            </ul>
                        </li>
                        @endif 
                    </ul>
                </div> 
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

