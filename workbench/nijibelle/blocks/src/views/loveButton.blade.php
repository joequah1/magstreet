@if($love['love']->isEmpty())
    <a href="#" class="love" id="love<?php echo $love['block']?>" title="love" data-toggle="love" data-hover="love">Love</a>
    <div id="youlove<?php echo $love['block']?>">
        <span id="you<?php echo $love['block']?>">
    </div>
    
@else
    <a href="#" class="love" id="love<?php echo $love['block']?>" title="unlove" data-toggle="love" data-hover="unlove">Unlove</a>
    <div id="youlove<?php echo $love['block']?>"><span id="you<?php echo $love['block']?>">You love this.
    </div>
@endif
        
    