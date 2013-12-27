Refien List
<ul>
@foreach($categories as $category)
    <li><a class="refine" data-category="<?php echo $category->id?>">{{$category->name}}</a></li>
@endforeach
</ul>


<script>
    /*
    * Refine Blocks
    */
    $('.refine').on('click', function(){
        var except = $(this).data('category');
        
        if(except == 1)
        {   
            $('.RefineList > div').slideDown(1000);
        }else
        {
            $('[data-category="'+except+'"]').slideDown(1000);
            
            $('.torefine').not('[data-category="'+except+'"]').hide(1000);
        }
    });
</script>