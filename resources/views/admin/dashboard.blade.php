@extends('layouts.app')
@section('title', 'Dashboard')

@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        @if (\Illuminate\Support\Carbon::now()->format('h') < 12)
          <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning,
            <span class="text-capitalize">{{ Auth::user()->name }}</span>!
          </h4>
        @elseif (\Illuminate\Support\Carbon::now()->format('h') < 18 && \Illuminate\Support\Carbon::now()->format('h') > 12)
          <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Afternoon,
            <span class="text-capitalize">{{ Auth::user()->name }}</span>!
          </h4>
        @elseif (\Illuminate\Support\Carbon::now()->format('h') > 18 && \Illuminate\Support\Carbon::now()->format('h') < 24)
          <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Evening,
            <span class="text-capitalize">{{ Auth::user()->name }}</span>!
          </h4>
        @else
          <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Night,
            <span class="text-capitalize">{{ Auth::user()->name }}</span>!
          </h4>
        @endif
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item text-muted active" aria-current="page">Jumlah Data</li>
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
    <x-count-data :label="'Blog'" :icon="'fab fa-blogger'" :count="$data['blogs']" />
    <x-count-data :label="'Adsense'" :icon="'fab fa-google'" :count="$data['adsenses']" />
    <x-count-data :label="'Domain'" :icon="'fas fa-globe'" :count="$data['domains']" />
    <x-count-data :label="'VPS'" :icon="'fas fa-server'" :count="$data['vpses']" />
  </div>

  <div class="row">
    <x-count-data :label="'Provider'" :icon="'fas fa-handshake'" :count="$data['providers']" />
    <x-count-data :label="'Topic'" :icon="'fas fa-comment-alt'" :count="$data['topics']" />
    <x-count-data :label="'Keyword'" :icon="'fas fa-tag'" :count="$data['keywords']" />
    <x-count-data :label="'Blog Keyword'" :icon="'fas fa-key'" :count="$data['blogsWithKeywords']" />
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
