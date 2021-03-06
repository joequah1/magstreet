<?php $latest = $data['latest']; ?>


@if(!$data['comments']->isEmpty())

@foreach($data['comments'] as $comment)

<div class="col-xs-12 col-dm-12 display-table border-bottom-1 padding-tb-10">
    <div class="col-xs-2 col-dm-2">
        <img src="<?php echo Users::getProfileImage($comment->person->id);?>" class="img-thumbnail profile-image-tumbnail" />
    </div>
    
    <div class="col-xs-10 col-dm-10">
        <div class="col-xs-12 col-dm-12 font-nexa-bold">
        {{$comment->person->firstname." ".$comment->person->lastname}}
            <div class="pull-right font-nexa-light font-size-10 italic">
                <div class="cutetime">{{$comment->created_at}}</div>
            </div>
        </div>
        <div class="col-xs-12 col-dm-12 comment ellipsis  font-nexa-light">
        {{$comment->message;}}
        </div>
    </div>
</div>

<!-- Get the latest offset -->
<?php $latest++; ?>

@endforeach
@endif

{{ Form::hidden('latest_comment',$latest,array('class'=>'latest_comment'))}}

<script>

    $('.comment.ellipsis').expander({
        slicePoint: 100,
        widow: 2,
        expandEffect: 'show',
        userCollapseText: '[^]'
    });
    
    $('.cutetime').cuteTime();
    
</script>