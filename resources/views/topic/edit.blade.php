@extends('layouts.app')
@section('title', 'Edit Topic')
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">{{ __('Edit Data Topic') }}</h4>
					
          {{-- <x-error-handling /> --}}
          <x-create-form :action="route('topic.update', $topic)">
            @csrf
            @method('PUT')
            <x-input-label :label="'Nama Topic'" name="name" :placeholder="'Informatika, Kesehatan ...'" :value="$topic->name" />
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection
