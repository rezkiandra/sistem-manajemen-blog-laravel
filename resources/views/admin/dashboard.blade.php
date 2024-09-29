@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
  <x-toast />
  <span>Dashboard</span>
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
