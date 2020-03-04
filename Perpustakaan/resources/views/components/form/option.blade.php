<div class="form-group">
    @php
        $label = User::getLabel($name)  
    @endphp
    {{ Form::label($name,$label, ['class' => 'control-label']) }}
    <?php array_unshift($option, "-- Choose ". ucwords($name). " --")?>
   {{ Form::select($name, $option, $selected, ['class' => 'form-control '. ($errors->has($name) ? 'is-invalid' : '')])}}

    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>