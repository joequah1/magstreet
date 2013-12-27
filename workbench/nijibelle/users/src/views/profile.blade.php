<div class="row" style="text-align:center;">

    <div class="row">
       
        <!-- Profile Image View and Upload -->
        <a href="#" data-toggle="modal" data-target="#uploadImageModal">
            @if(!$user->profileImage()->get()->isEmpty())
            <img width="200px" height="200px" src="<?php echo $user->profileImage[0]->path; ?>
                " class="img-circle"/>
            @else
                <img src="/img/download.png" width="90%"/>
            @endif
        </a>
    </div>
    <div class="row">
        
        <!-- Personal Details-->
        <table class="table" style="width:500px; margin:30px auto;">
            <tr>
                <th>Name</th>
                <td><?php echo $user->firstname." ".$user->lastname; ?></td>
                <th>Email</th>
                <td><?php echo $user->email;?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php if($user->gender == "m") echo "Male"; else echo "Female";?></td>
                <th>Birthday</th>
                <td><?php echo $user->dob;?></td>
            </tr>
        </table>
    
        <!-- Buttons -->
        @if(Users::isLogin())
        @if(\Auth::user()->id == $user->id)
        <a href="/<?php echo Config::get('users::route').'/settings'; ?>">
            <button class="btn btn-success">
                <span class="glyphicon glyphicon-pencil"></span>
                Edit
            </button>
        </a>
        @else
        <a href="/<?php echo 'friends/add/'.\Auth::user()->id.'/'.$user->id; ?>">
            <button class="btn btn-primary">
                <span class="glyphicon glyphicon-ok"></span>
                Add Friends
            </button>
        </a>
        
        @endif
        @endif
        
    </div>
    
    <!-- Friends List -->
    <h2 style="border-top:1px solid; padding: 10px;">Friends</h2>
    <div class="row" style="margin-top: 30px;">
        {{Friends::getFriendsListView($user->id);}}
    </div>
        
    <!-- Personal Wall -->
    <h2 style="border-top:1px solid; padding: 10px;">Blocks</h2>
    <div class="row" style="margin-top: 30px;">
        {{Blocks::getWall($user->id);}}
    </div>
    
    <!-- Upload Profile Image Modal -->
    {{Images::getUploadProfileImage();}}

