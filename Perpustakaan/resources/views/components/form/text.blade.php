<div class="form-group">
    @php
        $label = User::getLabel($name)  
    @endphp
    {{ Form::label($name,$label, ['class' => 'control-label']) }}
    
    {{ Form::text($name, $value, ['id' => $id,'class' => 'form-control '. ($errors->has($name) ? 'is-invalid' : ''),'placeholder' => $label]) }}
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>