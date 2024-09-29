@extends('layouts.app')
@section('title', 'Edit Adsense')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Adsense') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Adsense</li>
              <li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
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
          <h4 class="card-title mb-4">{{ __('Edit Data Adsense') }}</h4>
					
          {{-- <x-error-handling /> --}}
          <x-create-form :action="route('adsense.update', $adsense)">
            @csrf
            @method('PUT')
            <x-input-label :label="'Domain'" :name="'domain'" :placeholder="'https://domain@example.com'" :value="$adsense->domain" />
            <x-input-label :label="'Email'" :name="'email'" :type="'email'" :placeholder="'example@gmail.com'" :value="$adsense->email" />
						<x-input-label :label="'Password'" :name="'new_password'" :type="'password'" :placeholder="'******'" :value="$adsense->password"/>
            <x-input-label :label="'Status'" :name="'status'" :type="'select'" :placeholder="'Pilih status'" :value="$adsense->status" :options="$status" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection
