<div class="text-center">
  <img src="{{ asset('src/assets/images/big/icon.png') }}" alt="wrapkit">
</div>

<h2 class="mt-3 text-center">{{ $title }}</h2>
<p class="text-center">{{ $description }}</p>
<form class="mt-4" action="{{ $action }}" method="POST">
  <div class="row">
    {{ $slot }}

    <x-button :title="__('Login')" :type="'submit'" :class="'primary me-2'" :icon="'login'" />
    {{-- <div class="col-lg-12 text-center mt-5">
      Don't have an account?
      <a href="#" class="text-danger">Sign Up</a>
    </div> --}}
  </div>
</form>
