<?php 
    $last = 0;
?>
<div class=''>
    
    <div class="comment-group"></div>
    
    <div class="">
        <div class=""></div>
        <div class="">
            
            {{ Form::hidden('action',\URL::to('comments/update-comment'),array('class'=>'action')) }}
            
            <!-- required by real time and update jquery -->
            {{ Form::hidden('last_comment',$last,array('class'=>'last_comment'))}}
            {{ Form::hidden('from',$data['from'],array('class'=>'from'))}}
            {{ Form::hidden('id_comment',$data['id'],array('class'=>'id_comment')) }}
            
            <div class="form-group">
                <textarea name="comment" class='form-control comment text-autosize'></textarea>
            </div>        
     
        </div>
    </div>
</div>

<script>

    /**
    * Get comment real time
    *
    * @required .block_comment, .last_comment
    */
    realtime();
    function realtime(){
        var last = $('.last_comment').val();
        var id = $('.id_comment').val(); 
        var from = $('.from').val();
        
        if(typeof last === "undefined " || typeof id === "undefined " || typeof from === "undefined")
        {
            return;
        }
        
        $.get( "/comments/real-time/"+last+"/"+id+"/"+from, function(data) {
        
            $('.last_comment').remove();
            $('.comment-group').append(data);
        
            setTimeout(realtime,30000);
        }).fail(function(){
            alert('comments server error');
        })
        
    }
    
    /**
    * Submit with comment 
    *
    * @required .block_comment, .last_comment
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