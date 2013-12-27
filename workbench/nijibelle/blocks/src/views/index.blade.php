<div class="col-md-9 RefineList">
@foreach($blocks as $block)
<!-- Jquery Click Get -->

    <!-- Modal Click-->
    
        <div class="col-lg-3 col-sm-4 col-xs-6">
            <div class="panel panel-default" >
                <div class="" data-category="<?php echo $block->category_id;?>" data-toggle="fullblock" data-id="<?php echo $block->id?>" data-target="#blocksData">
                
                    <div data-toggle="modal" data-target="#blocksModal">
                        <div class="panel-body">
                            ID {{$block->id}}<br>
                            {{$block->created_at}}
                            <?php echo $block->firstname." ".$block->lastname; ?>
                        </div>
                        <div class="panel-body">
                            <img src="<?php echo $block->path;?>" width="90%"/>
                        </div>
                        <div class="panel-body">
                            <?php echo $block->caption;?>
                        </div>
                
                    </div>
                    </div>
                <div class="panel-body">
                    @if(\Users::isLogin())
                        {{ Blocks::getLoveButton($block->id); }}
                        {{ Shares::getShareButton($block->id, str_replace("/", '~', $block->path), 'block'); }}
                    @endif
                </div>
            </div>
        </div>

@endforeach
</div>
<div class="col-md-3">
    {{Categories::getRefine();}}
</div>

<!-- Modal -->
<div class="modal fade" id="blocksModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        
        <!-- Get Popup -->
        <div id="blocksData"></div>
        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    
    /*
    * Modal Close Remove Block
    */
    $('#blocksModal').on('hidden.bs.modal', function() {
        $('#blocksData').children().remove();  
    });

    /*
    * Block Full Popup
    */
    $('[data-toggle="fullblock"]').on('click',function(){
        var id = $(this).data("id");
        var target = $(this).data("target");
        var url = '/block/get/'+id;
        
        $.get( url, function(data) {
            $(target).html(data);
        }).fail(function(){
            alert('full block server error');
        })
    });
    
    /*
    * Love Button Jquery
    */
     $('[data-toggle="love"]').on('click',function(){
        var id = $(this).attr("id");
        var block=id.split("love")[1];
        var rel = $(this).data("hover");
        var url='/block/'+ rel + '/' + block;

        $.get( url, function() {}).done(function(){
            if(rel=='love')
            {
                $("#youlove"+block).prepend("<span id='you"+block+"'>You love this.</span>");
                $("#youlove"+block).slideDown('slow');
                $('#'+id).html('unlove').data('hover', 'unlove').attr('title', 'Unlove');
            }
            else
            {
                $("#youlove"+block).slideUp('slow');
                $('#'+id).html('Love').data('hover', 'love').attr('title', 'Love');
                $("#you"+block).remove();
            }
        }).fail(function(){
            alert('love server error');
        })

        return false;
    });
    
</script>

<script>
    $('[data-toggle="share-add"]').on('click',function(){
        
        var what = $(this).data('what');
        var id = $(this).data('id');
        var img = $(this).data('image');
       
        var url = "/share/add/"+what+"/"+id+"/"+img;
        
        $.get( url, function(data) {
            $('.share-content').html(data);
        }).fail(function(){
            alert('share server error');
        })
        
    });
    
    $('#shareModal').on('hidden.bs.modal', function() {
        $('.share-content').children().remove();  
    });
</script>