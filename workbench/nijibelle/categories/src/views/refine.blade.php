<style>
    .dropdown .close
    {
        background-image: url('img/iconsMagstreet.png');
        background-repeat: no-repeat;
        background-size: 180px 140px;
        background-position: -84px -62px;
    }
    
    .dropdown .open
    {
        background-image: url('img/iconsMagstreet.png');
        background-repeat: no-repeat;
        background-size: 180px 140px;
        background-position: -84px -62px;
    }
</style>

<div class="text-right">
    <span class="font-size-20 color-e35503 text-upper font-nexa-bold">Arrange As You Like</span>
    
    <div class="dropdown open">
      <div id="dLabel" data-toggle="dropdown" data-target="#dLabel">Dropdown trigger</div>
      <ul class="dropdown-menu-position list-style-none" role="menu" id="dLabel">
         <li class="list-style-none">s</li>
      </ul>
    </div>
    
    <div class="dropdown open">
        <div data-toggle="dropdown"  class="font-size-18 color-4b9db3 cursor-pointer font-nexa-bold" data-target="#category">
            By Category
            <span class="pull-right magstreeticon magstreeticon-arrow-down height-22 width-17"></span>
        </div>
        <ul class="dropdown-menu-position list-style-none font-size-12 " role="menu" id="category">
        @foreach($categories as $category)
            <li><div class="refine color-534842 cursor-pointer font-nexa-light" data-category="<?php echo $category->id?>">{{$category->name}}</div></li>
        @endforeach
        </ul>
    </div>
</div>

<script>
   
    /*
    * Dropdown toggle
    */
    $('.dropdown > [data-toggle="dropdown"]').on('click', function() {
        
        var target = $(this).data("target");
        
        $(this).children().toggleClass('magstreeticon-arrow-down magstreeticon-arrow-right');
        $(this).children().toggleClass('height-22 height-18');
        $(this).siblings(target).slideToggle( "slow" );
    });
    
    
    
    /*
    * Refine Blocks
    */
    $('.refine').on('click', function(){
        var except = $(this).data('category');
        
        if(except == 1)
        {   
            $('.RefineList > div').addClass('show');
            $('.RefineList > div').slideDown(1000);
        }else
        {
            $('[data-category="'+except+'"]').addClass('show');
            $('[data-category="'+except+'"]').slideDown(1000);
            
            $('.RefineList > div').not('[data-category="'+except+'"]').removeClass('show');
            $('.RefineList > div').not('[data-category="'+except+'"]').slideUp(1000);
        }
        
        dynamicGrid();
    });
</script>