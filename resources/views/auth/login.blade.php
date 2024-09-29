@extends('layouts.auth')
@section('title', 'Login')
@section('content')
  <h2 class="mt-3 text-center">{{ __('Login') }}</h2>
  <p class="text-center">{{ __('Masukkan kredensial untuk masuk ke aplikasi') }}</p>
  <form class="mt-4" action="{{ route('authenticate') }}" method="POST">
		@csrf
    <div class="row mt-2 mb-5">
			<x-toast />
      <div class="col-lg-12">
        <div class="form-group mb-3">
          <label class="form-label text-dark" for="email">{{ __('Email') }}</label>
          <input class="form-control" id="email" type="email" name="email" placeholder="masukkan email" value="{{ old('email') }}">
          @error('email')
            <small class="text-danger">
              <i class="far fa-flag me-1"></i>
              {{ $message }}
            </small>
          @enderror
        </div>
      </div>

      <div class="col-lg-12">
        <div class="form-group mb-3">
          <label class="form-label text-dark" for="password">{{ __('Password') }}</label>
          <input class="form-control" id="password" type="password" name="password" placeholder="*****">
					@error('password')
            <small class="text-danger">
              <i class="far fa-flag me-1"></i>
              {{ $message }}
            </small>
          @enderror
        </div>
      </div>
      <div class="col-lg-12 text-center">
        <button type="submit" class="btn w-100 btn-dark">{{ __('Login') }}</button>
      </div>
    </div>
  </form>
@endsection

@push('js')
	<script>
		document.addEventListener('DOMContentLoaded', function() {
      var toastElList = [].slice.call(document.querySelectorAll('.toast'));
      var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl, {
          autohide: true,
          delay: 5000
        }).show();
      });
    });
	</script>
@endpush