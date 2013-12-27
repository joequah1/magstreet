<?php $user = \Auth::user(); ?>

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Basic Information
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
          
{{ Form::open(array('action'=>'Nijibelle\Users\ProfileController@postUpdate', 'class'=>'form-signup, form-horizontal')) }}

{{Form::hidden('userId', $user->id)}}
   
<h2 class="form-signup-heading">Profile Update</h2>
    
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<div class="form-group">
    <label for="inputFirstName" class="col-sm-3 control-label">First Name</label>
    <div class="col-sm-9">
        {{ Form::text('firstname', $user->firstname, array('id'=>'inputFirstName', 'class'=>'form-control', 'placeholder'=>'First Name')) }}
    </div>
</div>

<div class="form-group">
    <label for="inputLastName" class="col-sm-3 control-label">Last Name</label>
    <div class="col-sm-9">
        {{ Form::text('lastname', $user->lastname, array('id'=>'inputLastName', 'class'=>'form-control', 'placeholder'=>'Last Name')) }}
    </div>
</div>

<div class="form-group">
   <?php 
        Form::macro('date', function($name,$array) {
            return '<input type="date" name="'.$name.'" class="'.$array['class'].'" value="'.$array['value'].'"/>';
        });
    ?>
    <label class="col-sm-3 control-label">Birthday</label>
    <div class="col-sm-9">
   {{ Form::date('dob', array('class'=>'form-control', 'value'=>$user->dob)) }}
        </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Gender</label>
    <div class="col-sm-9">
        <div class="radio">
            {{ Form::label('male','Male') }}
            {{ Form::radio('gender','m',$user->gender=="m"?true:false,array('id'=>'male')) }}
        </div>
        <div class="radio">
            
            {{ Form::label('female','Female') }}
            {{ Form::radio('gender','f',$user->gender=="f"?true:false,array('id'=>'female')) }}
        </div>
    </div>
</div>

<div class="form-group">
   {{ Form::submit('Save', array('class'=>'btn btn-large btn-primary btn-block'))}}
</div>

{{ Form::close() }}
          
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Password
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">

        {{ Form::open(array('action'=>'Nijibelle\Users\ProfileController@postUpdatePassword', 'class'=>'form-signup, form-horizontal')) }}
          
          {{Form::hidden('userId', $user->id)}}
          
          <div class="form-group">
              <label for="inputCurrent" class="col-sm-3 control-label">Current Password</label>
              <div class="col-sm-9">
                  {{ Form::password('password', array('id'=>'inputCurrent', 'class'=>'form-control', 'placeholder'=>'Password')) }}  
              </div>
          </div>
          
          <div class="form-group">
              <label for="inputPassword" class="col-sm-3 control-label">New Password</label>
              <div class="col-sm-9">
                  {{ Form::password('password_new', array('id'=>'inputPassword', 'class'=>'form-control', 'placeholder'=>'Password')) }}    
              </div>
          </div>
            
          <div class="form-group">
              <label for="inputConfirm" class="col-sm-3 control-label">Confirm Password</label>
              <div class="col-sm-9">
              {{ Form::password('password_new_confirmation', array('id'=>'inputConfirm', 'class'=>'form-control', 'placeholder'=>'Confirm Password')) }}    
              </div>
          </div>
          
          <div class="form-group">
              {{ Form::submit('Save', array('class'=>'btn btn-large btn-primary btn-block'))}}
          </div>
          
          {{ Form::close() }}
          
      </div>
    </div>
  </div>
    
</div>