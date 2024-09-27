@extends('layouts.app')
@section('title', 'Tambah Keyword')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Keyword') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Keyword</li>
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
          <h4 class="card-title mb-4">{{ __('Tambah Data Keyword') }}</h4>

          {{-- <x-error-handling /> --}}
          <x-create-form :action="route('keyword.store')">
            @csrf
            <x-input-label :label="'Nama Keyword'" :name="'name'" :class="'tagify'" :placeholder="'Masukkan keyword'" :value="old('name')" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- @push('css')
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify@latest/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify@latest/dist/tagify.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var input = document.querySelector('.tagify');
      var tagify = new Tagify(input);
    });
  </script>
@endpush --}}
