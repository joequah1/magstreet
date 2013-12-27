
{{ Form::open($data['form_options']) }}
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    {{ Form::submit('Share', array('class'=>'btn btn-primary'))}}
</div>

{{Form::hidden('target_share',$data['target_share'])}}
{{Form::hidden('id_share',$data['id_share'])}}
<div class="form-group">
    <textarea name="caption" class='form-control text-autosize'></textarea>
</div>

<div class="form-group">
    <img src="<?php echo str_replace("~", '/', $data['image'])?>" width="90%"/>
</div>

{{Form::close()}}
