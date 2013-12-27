{{ Form::open(array('action'=>'Nijibelle\Users\AuthenticationController@postLogin', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Please Login</h2>
 
<div class="form-group">
    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
</div>

<div class="form-group">
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
</div>

<div class="form-group">
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
</div>

@if(Config::get('users::social.facebook.status') == "true")
	<div class="form-group">
		<a href="<?= Social::login('facebook') ?>"><img src="<?= Config::get('users::social.facebook.img') ?>"></a>
	</div>	
@endif

@if(Config::get('users::social.google.status') == "true")
	<div class="form-group">
		<a href="<?= Social::login('google') ?>"><img width="250px" src="<?= Config::get('users::social.google.img') ?>"></a>
	</div>	
@endif

{{ Form::close() }}



