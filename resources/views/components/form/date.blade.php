<div class="form-group">
    @php
       $label = User::getLabel($name)  
    @endphp
      {{ Form::label($name, $label, ['class' => 'control-label']) }}
      {{ Form::date($name,$value, ['class' => 'form-control '. ($errors->has($name) ? 'is-invalid' : ''), $attributes]) }}
      @error($name)
          <div class="invalid-feedback">{{$message}}</div>
      @enderror
  </div>