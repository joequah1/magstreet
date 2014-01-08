<?php 
$hover = "remove";
$btn = "btn-success";
if($data['true'] == 0) 
{
    $hover = "add";
    $btn = "btn-primary";
}
?>
<div class="btn <?php echo $btn; ?>" data-toggle="friend" data-user="<?php echo $data['user']?>" data-target="<?php echo $data['friend']?>" data-hover="<?php echo $hover;?>">
    
    @if($data['true'] == 0)
    <span class="glyphicon glyphicon-plus"></span>
    <span class="text">Add Friend</span>
    @else
    <span class="glyphicon glyphicon-ok"></span>
    <span class="text">Friends</span>
    @endif
</div>

<script>
    /*
    * Add Friend Jquery
    */
    $('[data-toggle="friend"]').on('click',function(){
         var id = $(this).attr("id");
         var rel = $(this).data("hover");
         var user = $(this).data("user");
         var target = $(this).data("target");
        
        var url='/friends/'+ rel + '/' + user+'/'+target;
        
        $(this).children('.glyphicon').toggleClass('glyphicon-plus glyphicon-ok');
        $(this).toggleClass('btn-primary btn-success');
        if(rel == "remove")
        {
            $(this).children('.text').text('Add Friend');
        }else
        {
            $(this).children('.text').text('Friend');
        }
      
        $.get( url, function() {})

        return false;
    });
</script>