<style>
#expandable-textarea
{
	width:400px;
	resize:none;
}
</style>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
{{ HTML::script('packages/nijibelle/blocks/js/jquery.autosize.js') }}

<!-- Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="padding-top:100px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Upload Image</h4>
        </div>
        
        {{ Form::open($form_options) }}
        
        <div class="form-group">
            {{ Form::file('image', array('src'=>'#', 'id'=>'image-input', 'class'=>'')) }}
        </div>
        
        <div class="form-group">
            <img id="image-preview" alt="Image Preview" style="display: none;"  />
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {{ Form::submit('Upload', array('class'=>'btn btn-primary'))}}
        </div>
        
        {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

	$(function(){
		$('#expandable-textarea').autosize({append: "\n"});
	});

	function getExtension(filename) {
		var parts = filename.split('.');
		return parts[parts.length - 1];
	}

	function isImage(filename) {

		var ext = getExtension(filename);
		switch (ext.toLowerCase()) {
                
            case 'jpeg':
			case 'jpg':
			case 'gif':
			case 'bmp':
			case 'png':
		
			return true;
		}
		return false;
	}

	function readURL(input)
	{
		if (input.files && input.files[0])
		{
			var image = $('#image-input').val();

			if(!isImage(image))
			{
				alert('not image');
			}
			else{

				var reader = new FileReader();

				reader.onload = function (e)
				{	
					$('#image-preview')
					.attr('src',e.target.result)
					.show()
					.width(150)
					.height(200);

					$('#image-input').hide();
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
	}

	$('#image-input').on('change',function(){
            readURL(this);
        });
</script>

