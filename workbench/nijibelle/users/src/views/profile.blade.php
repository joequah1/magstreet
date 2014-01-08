<style>
    .profile-container
    {
        height: 428px;
        background-repeat:no-repeat;   
    }
    
    .edit-cover-photo
    {
        position: absolute;
        right: 15px;
        bottom: 0;
    }
    
    .profile-container:hover > .edit-cover-photo
    {
        display: block;
    }
    
    .cover-photo
    {
        position: absolute;
        top: 0;
        left: 0;   
    }
    
    .cover-photo img
    {
        height: 428px;
    }
    
    .profile-details
    {
        position: absolute;
        top: 100px;
        left: 40px;  
    }
    
    .btn
    {
        margin: 5px 0;
    }
    
    /* Smartphones (landscape) ----------- */
@media only screen 
and (min-width : 321px) {
/* Styles */
        
}

/* Smartphones (portrait) ----------- */
@media only screen 
and (max-width : 450px) {
/* Styles */
        
        .profile-details
        {
            position: absolute;
            top: 10px;
            left: 10px;  
        }
        
        .profile-img
        {
            margin: 0 auto;
            text-align: center;
        }
        
        .col-xxs-1, .col-xxs-2, .col-xxs-3, .col-xxs-4, .col-xxs-5, .col-xxs-6, .col-xxs-7, .col-xxs-8, 
        .col-xxs-9, .col-xxs-10, .col-xxs-11, .col-xxs-12
        {
            margin: 5px 0;
        }
        
        .col-xxs-12
        {
            width: 100%;
        }
        
        .col-xxs-0
        {
            width: 0%;
        }
        .col-xxs-1
        {
            width: 8.3333333%;
        }
        
        .col-xxs-2
        {
            width: 16.6666667%;
        }
        
        
        .col-xxs-3
        {
            width: 25%;
        }
        
        .col-xxs-4
        {
            width: 33.3333333%;
        }
        
        .col-xxs-6
        {
            width: 50%;
        }
        
        .col-xxs-8
        {
            width: 66.66666667%;
        }
        
        
}
    

    
</style>
<div class="row">
<div class="container col-sm-12 profile-container">
    
    <div class="cover-photo">
        <img src="/img/tumblr_m9b20xXJte1rocl37o1_1280.jpg" class="img-responsive"/>
    </div>
    
    <!-- Buttons -->
    @if(Users::isLogin())
    @if(\Auth::user()->id == $user->id)
    <div class="edit-cover-photo hidden-xs hidden-sm hidden-dm">
        <a href="/<?php echo Config::get('users::route').'/settings'; ?>">
            <button class="btn btn-success">
                <span class="glyphicon glyphicon-pencil"></span>
                Edit Profile
            </button>
        </a>
    </div>
    @else
    <div class="edit-cover-photo">
     
        
        {{Friends::getFriendButton(\Auth::user()->id,$user->id)}}
    </div>
    @endif
    @endif
    
    
    <div class="profile-details row width-100p">
        
        <div class="profile-img col-xxs-6 col-xs-4 col-sm-3 col-md-2">
            <a href="#" data-toggle="modal" data-target="#uploadImageModal">
                
                <img src="<?php echo $user->profileImage[0]->path;?>" class="img-thumbnail img-responsive"/>
              
            </a>
        </div>
        
        <div class="col-xxs-12 col-xs-8 col-sm-9 col-dm-10">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$user->firstname." ".$user->lastname}}</h3>
                    </div>
                    <div class="panel-body ellipsis">
                        {{$user->profileDescription->description}}
                    </div>
                </div>
            </div>
            
            <div class=" col-xs-12 col-sm-12 col-md-12 hidden-xs">
                <button class="btn">
                    <span class="pull-left magstreeticon magstreeticon-share"></span>
                    <div class="pull-left magstreettext">Shared 20 Cool Stuffs</div>
                </button>
                <button class="btn">
                    <span class="pull-left magstreeticon magstreeticon-friend"></span>
                    <div class="pull-left magstreettext">20 Cool Friends</div>
                </button>
            </div>
            
            
        </div>
    </div>
    
    </div>  
</div>
        
    <!-- Personal Wall -->
    <span style="padding: 10px;" class="color-0675ad font-nexa-bold font-size-24">Your Diary</span>
    <div class="row" style="margin-top: 30px;">
        {{Blocks::getWall($user->id);}}
    </div>
    
    <!-- Upload Profile Image Modal -->
    {{Images::getUploadProfileImage();}}


<script>
    
    

    
    $('.ellipsis').expander({
        slicePoint: 250,
        widow: 2,
        expandEffect: 'show',
        userCollapseText: '[^]'
    });

</script>