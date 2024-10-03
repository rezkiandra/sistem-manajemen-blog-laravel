@extends('layouts.app')
@section('title', 'Ganti Password')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Ganti Password') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data User</li>
              <li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <x-toast />
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">{{ __('Ganti Password') }}</h4>

          <x-error-handling />
          <x-create-form :action="route('dashboard.update-password', $user)">
            @csrf
            @method('PUT')
            <x-input-label :label="'Password Lama'" :name="'old_password'" :type="'password'" :placeholder="'******'" />
            <x-input-label :label="'Password Baru'" :name="'new_password'" :type="'password'" :placeholder="'******'" />
            <x-input-label :label="'Konfirmasi Password'" :name="'new_password_confirmation'" :type="'password'" :placeholder="'******'" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
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
