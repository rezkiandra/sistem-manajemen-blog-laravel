@extends('layouts.app')
@section('title', 'Tambah Topic')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Topic') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Topic</li>
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
          <h4 class="card-title mb-4">{{ __('Tambah Data Topic') }}</h4>

          {{-- <x-error-handling /> --}}
          <x-create-form :action="route('topic.store')">
            @csrf
            <x-input-label :label="'Nama Topik'" name="name" :placeholder="'Informatika, Kesehatan ...'" :value="old('name')" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection
