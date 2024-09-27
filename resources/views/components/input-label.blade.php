<div class="col-md-{{ $col }}">
  <div class="form-group mb-4">
    <label class="form-label">{{ $label }}</label>
    @if ($type == 'text' || $type == 'number' || $type == 'email' || $type == 'password')
      <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ is_array($value) ? implode(', ', $value) : $value }}"
        class="form-control {{ $class }} @error($name) is-invalid @enderror" min="{{ $min }}"
        max="{{ $max }}" step="{{ $step }}">
    @elseif ($type == 'select' || $type == 'select2')
      <select name="{{ $name }}" id="{{ $name }}"
        class="form-select {{ $class }} {{ $type == 'select2' ? 'select2' : '' }} @error($name) is-invalid @enderror">
        @if (!$value)
          <option selected disabled>{{ $placeholder }}</option>
        @endif
        @foreach ($options as $option)
          @if (is_array($option))
            @foreach ($option as $key => $label)
              <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          @elseif(is_object($option))
            <option value="{{ $option->id }}" {{ old($name, $value) == $option->id ? 'selected' : '' }}>
              {{ $option->{$field} }}
            </option>
          @endif
        @endforeach
      </select>
    @endif
    @error($name)
      <small class="text-danger">
        <i class="far fa-flag me-1"></i>
        {{ $message }}
      </small>
    @enderror
  </div>
</div>
