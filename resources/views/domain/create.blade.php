@extends('layouts.app')
@section('title', 'Tambah Domain')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Domain') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Domain</li>
              <li class="breadcrumb-item text-muted active" aria-current="page">Tambah</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">{{ __('Tambah Data Domain') }}</h4>

          {{-- <x-error-handling /> --}}
          <x-create-form :action="route('domain.store')">
            @csrf
            <x-input-label :label="'Domain'" name="domain" :placeholder="'https://domain@example.com'" :value="old('domain')" />
            <x-input-label :label="'Provider'" name="provider_id" :type="'select'" :placeholder="'Pilih provider'" :options="$providers" :field="'name'" />
            <x-input-label :label="'Email'" name="email" :type="'email'" :placeholder="'example@gmail.com'" :value="old('email')" />
            <x-input-label :label="'Password'" name="password" :type="'password'" :placeholder="'******'" :value="old('password')" />
            <x-input-label :label="'Masa Aktif'" name="masa_aktif" :type="'number'" :placeholder="'30'" :value="old('masa_aktif')" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection
