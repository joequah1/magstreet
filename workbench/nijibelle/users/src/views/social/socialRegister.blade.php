
{{ Form::open(array('action'=>'Nijibelle\Users\AuthenticationController@postRegister', 'class'=>'form-signup')) }}
   
<h2 class="form-signup-heading">Please Register</h2>
    
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
 
<div class="form-group">
    {{ Form::text('', $firstname, array('class'=>'form-control', 'disabled')) }}
    {{ Form::hidden('firstname',$firstname) }}
</div>

<div class="form-group">
   {{ Form::text('', $lastname, array('class'=>'form-control', 'disabled')) }}
    {{ Form::hidden('lastname',$lastname) }}
</div>

<div class="form-group">
   {{ Form::text('', $email, array('class'=>'form-control', 'disabled')) }}
    {{ Form::hidden('email',$email) }}
</div>

<div class="form-group">
   {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
</div>

<div class="form-group">
   {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
</div>

<div class="form-group">
   {{ Form::text('dob', $dob, array('class'=>'form-control','disabled')) }}
    {{ Form::hidden('dob',$dob) }}
</div>

<div class="radio">
    {{ Form::label('male','Male') }}
    {{ Form::radio('gender','m',$gender == "male"?true:false,array('id'=>'male','disabled')) }}
</div>
<div class="radio">
    {{ Form::label('female','Female') }}
    {{ Form::radio('gender','f',$gender == "female"?true:false,array('id'=>'female','disabled')) }}
</div>

    {{ Form::hidden('gender',$gender =="male"? 'm':'f') }}

<div class="form-group">
   {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
</div>

{{ Form::close() }}
