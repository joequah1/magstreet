<style>
</style>

<!-- Share Button -->
<div class="magstreet-block-meta">
    <a href="#" class="pull-left share-button" data-toggle="share-add" data-image='<?php echo $data["image"];?>' data-id_share="<?php echo $data['id_share']?>" data-target_share="<?php echo $data['target_share'];?>" >
        <div class="" data-toggle="modal" data-target="#shareModal" >
            <span class="magstreeticon magstreeticon-share"></span>
        </div>
    </a>


<!-- Share Count -->
<span class="text">{{$data['count']}}</span>

</div>

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <div class="share-content"></div>
      
        </div>
    </div>
</div>

