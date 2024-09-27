@extends('layouts.app')
@section('title', 'Edit VPS')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('VPS') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data VPS</li>
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
          <h4 class="card-title mb-4">{{ __('Edit Data VPS') }}</h4>
					
          {{-- <x-error-handling /> --}}
          <x-create-form :action="route('vps.update', $vps)">
            @csrf
            @method('PUT')
            <x-input-label :label="'Provider'" :name="'provider_id'" :type="'select'" :placeholder="'Pilih provider'" :value="$vps->provider_id" :options="$providers" :field="'name'" />
            <x-input-label :label="'Email'" :name="'email'" :type="'email'" :placeholder="'example@gmail.com'" :value="$vps->email" />
            <x-input-label :label="'New Password (opsional)'" :name="'new_password'" :type="'password'" :placeholder="'******'" />
            <x-input-label :label="'IP Address'" :name="'ip'" :placeholder="'192.168.0.**'" :value="$vps->ip" :col="'4'" />
            <x-input-label :label="'CPU'" :name="'cpu'" :type="'number'" :placeholder="'1-20'" :value="$vps->cpu" :max="20" :col="'4'"  />
            <x-input-label :label="'RAM'" :name="'ram'" :type="'number'" :placeholder="'1-50'" :value="$vps->ram" :max="50" :col="'4'" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection
