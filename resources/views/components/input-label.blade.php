<div class="col-md-{{ $col }}">
  <div class="form-group mb-4">
    <label class="form-label">{{ $label }}</label>

    @if (in_array($type, ['text', 'number', 'email', 'password']))
      <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ is_array($value) ? implode(', ', $value) : $value }}"
        class="form-control {{ $class }} @error($name) is-invalid @enderror" min="{{ $min }}"
        max="{{ $max }}" step="{{ $step }}">
    @elseif (in_array($type, ['select', 'select2']))
      <select name="{{ $name }}{{ $type == 'select2' ? '[]' : '' }}" id="{{ $name }}"
        class="form-select {{ $class }} {{ $type == 'select2' ? 'select2' : '' }} @error($name) is-invalid @enderror"
        {{ $type == 'select2' ? 'multiple' : '' }}>

        @if ($type == 'select' && !$value)
          <option selected disabled>{{ $placeholder }}</option>
        @endif

        @foreach ($options as $option)
          @if (is_array($option))
            @foreach ($option as $key => $label)
              <option value="{{ $key }}"
                {{ $type == 'select' && old($name, $value) == $key ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          @elseif (is_object($option))
            <option value="{{ $option->{$valueField ?? 'id'} }}"
              {{ $type == 'select' && old($name, $value) == $option->{$valueField ?? 'id'} ? 'selected' : '' }}>
              {{ $option->{$labelField ?? $field} }}
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
