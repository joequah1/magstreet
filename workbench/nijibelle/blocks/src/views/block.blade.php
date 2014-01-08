<style>
    .fixed-on-top 
    {
        position:fixed;
        top: 0;
    }
    
</style>

<?php $block = $data['block']; ?>
<div class="col-dm-9 background-color-ffeeee" >
    
    <div class="">
    
    </div>
    
    <div class="to-fix-on-top background-color-ffffff width-100p padding-tb-10 margin-auto display-table">
        <div class="col-xs-6 col-sm-6">
            <div class="col-xs-4 col-sm-4">              
                <img src="<?php echo Users::getProfileImage($block->person->id);?>" class="img-thumbnail profile-image-tumbnail" />
                
            </div>
            <div class="col-xs-8 col-sm-8">
                <span class="font-nexa-bold font-size-14">{{$block->person->firstname." ".$block->person->lastname}}</span>
            </div>
            <div class="col-xs-8 col-sm-8">
                <div class="cutetime font-nexa-light font-size-12 italic">{{$block->created_at}}</div>
            </div>
        </div>
        
        <div class="col-xs-6 col-sm-6">
            @if(\Users::isLogin())
        
            <div class="pull-right">
                {{Comments::getCommentCount($data['comment_target_id'], $data['comment_table_from'])}}
            </div>
            <div class="pull-right">
                {{ Shares::getShareButton($data['comment_target_id'], str_replace("/", '~', $block->image->path), "block"); }}
            </div>
            <div class="pull-right">
                {{ Loves::getLoveButton($data['comment_target_id'], $data['comment_table_from']); }}
            </div>
            
            
            @endif
        </div>  
    </div>
    
    <div class="padding-20" style="">
        <img src="<?php echo $block->image->path;?>" class="img-responsive margin-auto"/>
    </div>
    
    @if(!is_null($data['share_caption']))
    <div class="background-color-ffffff padding-20 border-bottom-1">
        {{$data['share_caption']->caption}}
    </div>
    @endif
    
    <div class="background-color-ffffff padding-20">
        {{$block->caption}}
    </div>
    
</div>

<div class="margin-tb-10">
        {{Comments::getComments($data['comment_target_id'], $data['comment_table_from']);}}
</div>


<script>

    $('.cutetime').cuteTime();
    
    $(document).ready(function() {
    var s = $(".to-fix-on-top");
    var pos = s.position();                    
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        
        if (windowpos >= pos.top) {
            s.addClass("fixed-on-top");
        } else {
            s.removeClass("fixed-on-top"); 
        }
    });
    });
    
</script>
