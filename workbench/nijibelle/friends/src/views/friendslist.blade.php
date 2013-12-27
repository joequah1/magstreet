<style>
    .friend-wrapper img
    {
        width: 150px;
        height: 150px;
    }
    .friend-wrapper .name 
    {
        opacity: 0.5;
        background: black;
        color: white;
        font-size: 14px;
        position: relative;
        bottom: 20px;
        left: 0px;
        visibility: hidden;
    }
    
    .friend-wrapper:hover .name 
    {
        visibility:visible;
    }
</style>

@foreach($friends as $friend)
    <div class="col-lg-2">
        <div class="" >
                @if(!$friend->friendImage->isEmpty())
                <div class="friend-wrapper">
                    <img src="<?php print_r ($friend->friendImage[0]->path); ?>"/>
                    <p class="name">{{$friend->friend->firstname." ".$friend->friend->lastname;}}</p>
                </div>    
                @else
                <div class="friend-wrapper">
                    <img src="/img/download.png"/>
                    <p class="name">{{$friend->friend->firstname." ".$friend->friend->lastname;}}</p>
                </div>
                @endif
        </div>
    </div>
@endforeach