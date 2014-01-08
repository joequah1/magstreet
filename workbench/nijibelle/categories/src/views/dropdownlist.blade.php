<select name="category" class="form-control">
    <option value="0">-- Select Category --</option>
    @foreach($categories as $id=>$category)
    @if($id > 0)
        <option value="<?php echo $id;?>">{{$category}}</option>
    @endif
    @endforeach
</select>