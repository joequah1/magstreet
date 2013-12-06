
{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
   
<h2 class="form-signup-heading">Please Register</h2>
    
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
 
<div class="form-group">
    {{ Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'First Name')) }}
</div>

<div class="form-group">
   {{ Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Last Name')) }}
</div>

<div class="form-group">
   {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
</div>

<div class="form-group">
   {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
</div>

<div class="form-group">
   {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
</div>

<div class="form-group">
   <?php 
        Form::macro('date', function($name,$array) {
            return '<input type="date" name="'.$name.'" class="'.$array['class'].'" value=""/>';
        });
    ?>
   {{ Form::date('dob', array('class'=>'form-control')) }}
</div>

<div class="radio">
    {{ Form::label('male','Male') }}
    {{ Form::radio('gender','m',true,array('id'=>'male')) }}
</div>
<div class="radio">
    {{ Form::label('female','Female') }}
    {{ Form::radio('gender','f','',array('id'=>'female')) }}
</div>

<div class="form-group">
   {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
</div>

{{ Form::close() }}