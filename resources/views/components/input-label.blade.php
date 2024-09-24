<div class="col-md-{{ $col }}">
  @if ($type != 'select')
    <div class="form-group mb-4">
      <label class="form-label">{{ $label }}</label>
      <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}" class="form-control" placeholder="col-md-6"
        min="{{ $min }}">
      @error($name)
        <small class="text-danger">
          <i class="far fa-flag me-1"></i>
          {{ $errors->first($name) }}
        </small>
      @enderror
    </div>
  @else
    <div class="form-group mb-4">
      <label class="form-label">{{ $label }}</label>
      <select name="{{ $name }}" id="{{ $name }}" class="form-select">
        @if (!$value)
          <option selected disabled value="">{{ $placeholder }}</option>
        @endif
        @foreach ($options as $key => $option)
          <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
            {{ $option }}
          </option>
        @endforeach
      </select>
      @error($name)
        <small class="text-danger">
          <i class="far fa-flag me-1"></i>
          {{ $errors->first($name) }}
        </small>
      @enderror
    </div>
  @endif
</div>
