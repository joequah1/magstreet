

<select class="image-picker imageRecommendations" name="image">
@foreach($data['images']->d->results as $value)
    <option 
  data-img-src="<?php echo $value->Thumbnail->MediaUrl?>" value="<?php echo $value->Thumbnail->MediaUrl;?>"></option>
@endforeach
</select>

<script>
    $("select.imageRecommendations").imagepicker();
    
</script>