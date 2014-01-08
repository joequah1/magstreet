@if($data['love']->isEmpty())
<div class="magstreet-block-meta">
    <div class="love pull-left cursor-pointer" id="love<?php echo $data['block']?>" title="love" data-toggle="love" data-hover="love" data-target="<?php echo $data['target']?>">
        <span class="magstreeticon magstreeticon-love opacity-25" ></span>
    </div>
    
    <span class="text">
    {{$data['count']}}
    </span>
    
    <div id="youlove<?php echo $data['block']?>">
        <span id="you<?php echo $data['block']?>">    
    </div>
</div>
@else
<div class="magstreet-block-meta">    
    <div class="love pull-left cursor-pointer" id="love<?php echo $data['block']?>" title="unlove" data-toggle="love" data-hover="unlove" data-target="<?php echo $data['target']?>">
        <span class="magstreeticon magstreeticon-love"></span>
    </div>
    
    <span class="text">    
    {{$data['count']}} 
    </span>

</div>
@endif
        
    