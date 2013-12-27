<div class="">

    <img src="<?php echo $data['block']->image->path;?>" width="400px"/>
    {{$data['block']->caption}}
    
    <div class="">
        {{Comments::getComments($data['comment_target_id'], $data['comment_table_from']);}}
    </div>
    
</div>