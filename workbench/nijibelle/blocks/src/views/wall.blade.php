<style>

    .thumbnail
    {
        padding:0px;
    }
    
    .thumbnail img
    {
        max-width: 100%;
    }
    
    .grid
    {
        -webkit-transition: top 1s ease, left 1s ease;
        -moz-transition: top 1s ease, left 1s ease;
        -o-transition: top 1s ease, left 1s ease;
        -ms-transition: top 1s ease, left 1s ease;
    }
    
    .profile-image-tumbnail
    {
        max-width: 50px;
        max-height: 50px;
    }
    
    .fade
    {
        background: rgba(149,201,215, .5);
    }
    
    .image-thumbnail-fix img
    {
        width: 31px;
        height: 31px;
    }
    
    media="all"
    @media screen and (min-width : 1080px) {
    /* Styles */  
        .modal-dialog
        {
            width: 980px;
        }
    }
    
</style>

<div class="col-sm-9 col-md-9 RefineList objectID"> 
@foreach($blocks as $block)
<!-- Jquery Click Get -->

    <!-- Modal Click-->

    <div class="grid show" data-category="<?php echo $block->category_id;?>" 
         <?php 
            if(!Users::isLogin())
            {
                echo 'data-toggle="modal" data-target="#loginModal"';
            }
         ?>>
        
        <div class="thumbnail">
        
            <!-- Div use for refining -->
            <div class="torefine" data-category="<?php echo $block->category_id;?>">
            
                <div <?php 
                     if(Users::isLogin())
                     {
                         echo "data-toggle='modal' data-target='#blocksModal' data-id='$block->id' data-targets='#blocksData' data-from='$block->tablename' data-share='$block->share'";
                     }
                     ?>>
                  
                    <!-- Block Image -->
                    <img src="<?php echo $block->path;?>"/>
                    
                    <!-- Block Content -->
                    <div class="panel-body color-534842">
                        <p class="font-nexa-light font-size-12">{{$block->caption}}</p>
                    </div>
            
                </div>
                
            </div>
            
           
            <!-- Source of Share -->
            @if($block->tablename == "shares")
            <div class="italic font-size-10 col-sm-12 col-dm-12">source</div>
           
            <div class="col-xs-4 col-sm-4 image-thumbnail-fix">
                
                <img src="<?php echo Users::getProfileImage($block->source);?>" />
                
            </div>
            <div class="col-xs-8 col-sm-8 font-size-12">
                <span class="font-nexa-bold">{{$block->firstname." ".$block->lastname}}</span>
                
            </div>
            @endif
            
            <div class="clear padding-tb-10"></div>
                
            <!-- Editor -->
            <div class="col-xs-4 col-sm-4 image-thumbnail-fix">
                
                <img src="<?php echo Users::getProfileImage($block->userid);?>"/>
                
            </div>
            <div class="col-xs-8 col-sm-8 font-size-12">
                <span class="font-nexa-bold">{{$block->firstname." ".$block->lastname}}</span>
                @if($block->tablename == "shares")
                    shared this
                @endif
            </div>
            <div class="col-xs-4 col-sm-4"></div>
            <div class="col-xs-8 col-sm-8">
               
                <div class="pull-left">
                    @if($block->tablename == "shares")
                    {{ Loves::getLoveButton($block->share, $block->tablename); }}
                    @else
                    {{ Loves::getLoveButton($block->id, $block->tablename); }}
                    @endif
                </div>
                <div class="pull-left">
                    {{ Shares::getShareButton($block->id, str_replace("/", '~', $block->path), 'block'); }}
                </div>
                <div class="pull-left">
                    @if($block->tablename == "shares")
                    {{Comments::getCommentCount($block->share,$block->tablename)}}
                    @else
                    {{Comments::getCommentCount($block->id,$block->tablename)}}
                    @endif
                </div>
               
            </div>
            
            <div class="col-xs-12 col-dm-12 overflow-hidden">
                <div class="cutetime font-nexa-light font-size-10 italic">{{$block->created_at}}</div>    
            </div>
            
        </div>
    </div>

@endforeach
</div>
<div class="col-sm-3 col-md-3">
    {{Categories::getRefine();}}
</div>

<!-- Modal -->
<div class="modal fade" id="blocksModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog container">
        
        <!-- Get Popup -->
        <div id="blocksData"></div>
        
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog container">
        
      <div class="modal-content">  
          <!-- Get Popup -->
          <div id="loginForm"></div>
      </div>
        
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    
    $(document).ready(function() {
        
        dynamicGrid();

    });
    
    $('.cutetime').cuteTime();
    
    function dynamicGrid()
    {
        var currentWidth = $(window).width();
        
        if(currentWidth > 1080)
        {   
            $('.objectID').BlocksIt({  
              numOfCol: 4,
              offsetX: 2,
              offsetY: 2,
              blockElement: '.grid.show',
            });
        }else if(currentWidth > 900)
        {
            $('.objectID').BlocksIt({  
              numOfCol: 3,
              offsetX: 2,
              offsetY: 2,
              blockElement: '.grid.show',
            });
            
        }else if(currentWidth > 660 )
        {
            $('.objectID').BlocksIt({  
              numOfCol: 2,
              offsetX: 2,
              offsetY: 2,
              blockElement: '.grid.show',
            });
        }
    };
    
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
    * Modal Close Remove Block
    */
    $('#loginModal').on('hidden.bs.modal', function() {
        $('#loginForm').children().remove();  
    });

    /*
    * Block Full Modal
    */
    
    $('#loginModal').on('show.bs.modal', function(e) {
        
        var url = '/user/login-form';
        
        $.get( url, function(data) {
            $('#loginForm').html(data);
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
        var target = $(this).data("target");
        
        var url='/'+ rel + '/' + block+'/'+target;
        
         $(this).children().toggleClass('opacity-25');
        $.get( url, function() {}).done(function(){
            if(rel=='love')
            {
                $('#'+id).data('hover', 'unlove').attr('title', 'Unlove');
            }
            else
            {
                $('#'+id).data('hover', 'love').attr('title', 'Love');
            }
        }).fail(function(){
            alert('love server error');
        })

        return false;
    });
    
    
    
    /*
    * Login
    */
    
    $('.auth-login').on('click', function() {
        alert('login please');
    });
    
</script>

 