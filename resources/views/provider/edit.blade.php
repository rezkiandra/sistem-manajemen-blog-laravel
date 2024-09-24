@extends('layouts.app')
@section('title', 'Edit Provider')
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">{{ __('Edit Data Provider') }}</h4>
					
          {{-- <x-error-handling /> --}}
          <x-create-form :action="route('provider.update', $provider)">
            @csrf
            @method('PUT')
            <x-input-label :label="'Nama Provider'" name="name" :placeholder="'Telkomsel, Indosat ...'" :value="$provider->name" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection
