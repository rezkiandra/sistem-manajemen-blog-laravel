@extends('layouts.app')
@section('title', 'Detail Blog Keyword')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Blog Keyword') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Blog Keyword</li>
              <li class="breadcrumb-item text-muted" aria-current="page">Detail</li>
              <li class="breadcrumb-item text-muted active" aria-current="page">{{ $blogKeyword->blog?->domain }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <i class="icon-user me-2"></i>
      <span>PIC : {{ $blogKeyword->blog?->pic }}</span>
    </div>
    <div class="card-body">
      <h4 class="card-title">
        <span>Domain : </span>
        <a href="{{ $blogKeyword->blog?->domain }}"
          class="text-decoration-underline">{{ $blogKeyword->blog?->domain }}</a>
      </h4>
      <p class="card-text d-flex flex-column gap-2 my-4">
        <span>Topic : {{ $blogKeyword->blog?->topic?->name }}</span>
        <span>Status : {{ $blogKeyword->blog?->status }}</span>
        <span>Provider : {{ $blogKeyword->blog?->provider?->name }}</span>
        <span>Language : {{ $blogKeyword->blog?->lang }}</span>
        <span>Traffic views : {{ $blogKeyword->blog?->traffic_views }}</span>
        <span>DA : {{ $blogKeyword->blog?->domain_authority }}</span>
        <span>DR : {{ $blogKeyword->blog?->domain_rating }}</span>
      </p>
      <span>Keywords</span>
      <small>
        <ol>
          @foreach ($blogKeyword->keyword as $keywordGroup)
            @foreach ($keywordGroup as $keyword)
              <li>{{ $keyword }}</li>
            @endforeach
          @endforeach
        </ol>
      </small>
    </div>
    <div class="card-footer">
      <div class="d-flex align-items-center gap-2">
        <a href="{{ route('blog-keyword.edit', $blogKeyword) }}" class="btn btn-primary btn-sm">
          <i class="fas fa-key me-1"></i>
          <span>Edit keyword</span>
        </a>
        <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $blogKeyword->id }}"
          data-bs-toggle="modal" data-bs-target="#primary-header-modal">
          <i class="fas fa-trash me-1"></i>
          <span>Hapus keyword</span>
        </button>
        <a href="{{ route('blog-keyword.edit', $blogKeyword) }}" class="btn btn-secondary btn-sm">
          <i class="fab fa-blogger me-1"></i>
          <span>Edit blog</span>
        </a>
      </div>
    </div>
  </div>

  <x-delete-modal />
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $('.delete-btn').on('click', function() {
        var id = $(this).data('id');
        var formAction = "{{ route('blog-keyword.destroy', ':id') }}";
        formAction = formAction.replace(':id', id);

        $('#deleteForm').attr('action', formAction);
        $('#primary-header-modal').modal('show');
      });
    });
  </script>
@endpush
