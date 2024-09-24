@extends('layouts.app')
@section('title', 'Edit Adsense')
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
            <x-input-label :label="'Domain'" name="domain" :placeholder="'https://domain@example.com'" :value="$adsense->domain" />
            <x-input-label :label="'Email'" name="email" :type="'email'" :placeholder="'example@gmail.com'" :value="$adsense->email" />
						<x-input-label :label="'New Password (opsional)'" name="new_password" :type="'password'" :placeholder="'******'" />
            <x-input-label :label="'Status'" name="status" :type="'select'" :placeholder="'Pilih status'" :value="$adsense->status" :options="$optionStatus" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection
