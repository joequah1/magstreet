<style>
.share-button {
    cursor: default;
    color: red;
}
</style>

<div class="share-button" data-toggle="share-add" data-image='<?php echo $data["image"];?>' data-id_share="<?php echo $data['id_share']?>" data-target_share="<?php echo $data['target_share'];?>" ><div class="" data-toggle="modal" data-target="#shareModal" >Share</div></div>

<!-- Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <div class="share-content"></div>
      
        </div>
    </div>
</div>

