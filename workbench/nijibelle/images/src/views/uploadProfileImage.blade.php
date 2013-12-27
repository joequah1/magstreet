<style>
#expandable-textarea
{
	width:400px;
	resize:none;
}
    
    .image-upload-container
    {
        background: white;
        width: 968px;
        height: 500px;
        margin:0 auto;
    }

</style>


<!-- Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="image-upload-container">
    <div class="">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Upload Image</h4>
        </div>
 
        {{ Form::open($form_options) }}
            
        {{ Form::close() }}
     
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="submit-profile-pic" class="btn btn-primary">Submit</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
Dropzone.options.myAwesomeDropzone = {
    paramName: "image", // The name that will be used to transfer the file
    maxFilesize: 5,
    autoProcessQueue: false,
    uploadMultiple  : false,
    addRemoveLinks : true,
    createImageThumbnails : true,
    init: function() {
        this.on("addedfile", function() {
        if (this.files[1]!=null){
            this.removeFile(this.files[0]);
        }
        });
        
        var submitButton = document.querySelector("#submit-profile-pic")
        myDropzone = this; // closure

        submitButton.addEventListener("click", function() {
            myDropzone.processQueue(); // Tell Dropzone to process all queued files.
            //location.reload();
        });
        
        this.on("success", function(files, response) {
      // Gets triggered when the files have successfully been sent.
      // Redirect user or notify of success.
            location.reload();
    });
        
    },
    accept: function(file, done) {
        if (file.type != "image/jpeg" && file.type != "image/png") {
        alert('format error');
        }
        else { done();}
    }
};
    
</script>