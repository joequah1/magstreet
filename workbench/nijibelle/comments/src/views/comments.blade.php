<?php 
    $latest = $data['offset'];
    if($latest < 0) $latest = 0;
    $previous = $data['offset'] - 5;
?>
<div class='col-xs-12 col-dm-12 background-color-ffffff display-table padding-20'>
    <div class="col-xs-12 col-dm-12 display-table">
        <div class="btn btn-primary previous-comments-btn width-100p">Previous</div>
    </div>
    
    <div class="col-xs-12 col-dm-12 comment-group ">
        
    </div>
    
    <div class="col-xs-12 col-dm-12 ">
        <div class="col-xs-2 col-dm-2 padding-tb-10 padding-left-30">
            <img src="<?php echo Users::getProfileImage(Users::getLoginId());?>" class="img-thumbnail profile-image-tumbnail" />
        </div>
        <div class="col-xs-10 col-dm-10 padding-tb-10 padding-left-30">
            
            {{ Form::hidden('action',\URL::to('comments/update-comment'),array('class'=>'action')) }}
            
            <!-- required by real time and update jquery -->
            {{ Form::hidden('latest_comment',$latest,array('class'=>'latest_comment'))}}
            {{ Form::hidden('from',$data['from'],array('class'=>'from'))}}
            {{ Form::hidden('id_comment',$data['id'],array('class'=>'id_comment')) }}
            
            <!-- required to get previous comments -->
            {{ Form::hidden('previous_comment',$previous,array('class'=>'previous_comment'))}}
            
            <div class="form-group">
                <textarea name="comment" class='form-control comment text-autosize' placeholder="Your Comment here..."></textarea>
            </div>        
     
        </div>
    </div>
</div>

<script>
    
    realtime();
        
    var previous = $('.previous_comment').val();
    if(previous <= 0)
    {
        $('.previous-comments-btn').hide();
    }

    /**
    * Get comment real time
    *
    * @required .block_comment, .latest_comment
    */
    
    function realtime(){
        var latest = $('.latest_comment').val();
        var id = $('.id_comment').val(); 
        var from = $('.from').val();
        
        if(typeof latest === "undefined " || typeof id === "undefined " || typeof from === "undefined")
        {
            return;
        }
        
        $.get( "/comments/real-time/"+latest+"/"+id+"/"+from, function(data) {
        
            $('.latest_comment').remove();
            $('.comment-group').append(data);
        
            setTimeout(realtime,30000);
        }).fail(function(){
            alert('comments server error');
        })
        
    }
    
    function getPreviousComments() {
        var previous = $('.previous_comment').val();
        var id = $('.id_comment').val(); 
        var from = $('.from').val();
        
        if(typeof previous === "undefined " || typeof id === "undefined " || typeof from === "undefined")
        {
            return;
        }
        
        if(previous < 0)
        {
            $('.previous-comments-btn').hide();
        }
        
        $.get( "/comments/previous-comments/"+previous+"/"+id+"/"+from, function(data) {
        
            $('.previous_comment').remove();
            $('.comment-group').prepend(data);
        
            setTimeout(realtime,30000);
        }).fail(function(){
            alert('previous comments server error');
        })
    }
    
    $('.previous-comments-btn').on('click', function() {
        getPreviousComments();
    });
    
    /**
    * Submit with comment 
    *
    * @required .block_comment, .latest_comment
    */
    $("textarea.comment").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
   
        var msg = $('textarea.comment').val();
        var id = $('.id_comment').val();
        var from = $('.from').val();
        var url = $('.action').val();
    
        $.ajax({
            url: url,
            data: {"comment": msg, "id": id, "from": from}, 
            dataType: 'json',
            type: 'POST',
            success: function (res) {
                realtime();
                $('textarea.comment').val('');
            }
        });

        return false;  
    
    }
});
    
    
</script>