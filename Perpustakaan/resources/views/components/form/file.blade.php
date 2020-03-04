<div class="form-group">
  @php
     $label = User::getLabel($name)  
  @endphp
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    {{ Form::file($name, ['@change' => $method,'class' => 'form-control-file '. ($errors->has($name) ? 'is-invalid' : '')]) }}
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>