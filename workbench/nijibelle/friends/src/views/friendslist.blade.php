<style>
    .friend-wrapper img
    {
        width: 160px;
        height: 160px;
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
               
                <div class="friend-wrapper">
                    <img src="<?php echo Users::getProfileImage($friend->friend->id) ?>"/>
                    <p class="name text-center">{{$friend->friend->firstname." ".$friend->friend->lastname;}}</p>
                </div>    
                
        </div>
    </div>
@endforeach