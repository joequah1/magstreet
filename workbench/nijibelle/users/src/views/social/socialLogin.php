{{ Form::open(array('action'=>'Nijibelle\Users\SocialAuthController@postSocialLogin', 'id'=>'autosubmit')) }}
 {{ Form::hidden('email',$email) }}
{{ Form::close() }}

<script>document.getElementById('autosubmit').submit();</script>
