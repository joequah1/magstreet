<?php $last = $data['last']; ?>
@if(!$data['comments']->isEmpty())
<?php $last = $data['comments'][count($data['comments'])-1]->id; ?>
@foreach($data['comments'] as $comment)

<div class="">
    <div class="">
        
    </div>
    <div class="">
        {{$comment->person->firstname." ".$comment->person->lastname."\t".$comment->message;}}
    </div>
</div>

@endforeach
@endif

{{ Form::hidden('last_comment',$last,array('class'=>'last_comment'))}}