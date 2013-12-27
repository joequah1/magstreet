<div class="col-md-9 RefineList objectID">
@foreach($blocks as $block)
<!-- Jquery Click Get -->

    <!-- Modal Click-->
    
        <div class="">
            <div class="grid" >
                <div class="torefine" data-category="<?php echo $block->category_id;?>">
                
                    <div data-toggle="modal" data-target="#blocksModal" data-id="<?php echo $block->id?>" data-targets="#blocksData" data-from="<?php echo $block->tablename;?>" data-share="<?php echo $block->share;?>">
                        <div class="panel-body">
                            
                            {{$block->firstname." ".$block->lastname}}
                            @if($block->tablename == "shares")
                                shared this
                            @endif
                        </div>
                        <div class="panel-body">
                            <img src="<?php echo $block->path;?>" width="90%"/>
                        </div>
                        <div class="panel-body">
                            {{$block->caption}}
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
    $(document).ready(function() {
        $('.objectID').BlocksIt({  
          numOfCol: 3,
          offsetX: 8,
          offsetY: 8,
        });
    });
    
    /*
    * Modal Close Remove Block
    */
    $('#blocksModal').on('hidden.bs.modal', function() {
        $('#blocksData').children().remove();  
    });

    /*
    * Block Full Modal
    */
    
    $('#blocksModal').on('show.bs.modal', function(e) {
        
        var id = $(e.relatedTarget).data("id");
        var target = $(e.relatedTarget).data("targets");
        var from = $(e.relatedTarget).data("from");
        var share = $(e.relatedTarget).data("share");
        
        var url = '/block/get/'+id+'/'+from+'/'+share;
        
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

 