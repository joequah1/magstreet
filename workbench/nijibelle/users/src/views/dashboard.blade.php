<?php 

$user = \Auth::user();

?>

<div class="row" style="text-align:center;">

    <div class="row">
        <img src="/img/download.png" class="img-circle"/>
    </div>
    <div class="row">
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
    
    <a href="/<?php echo Config::get('users::route').'/profile'; ?>">
        <button class="btn btn-warning">
            <span class="glyphicon glyphicon-pencil"></span>
            Edit
        </button>
    </a>
        
    
</div>
    
<h2 style="border-top:1px solid; padding: 10px;">Blocks</h2>
<div class="row" style="margin-top: 30px;">
    {{ App::make('blocks')->getWall();}}
</div>

