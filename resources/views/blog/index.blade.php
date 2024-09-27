@extends('layouts.app')
@section('title', 'List Blog')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Blog') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Blog</li>
              <li class="breadcrumb-item text-muted active" aria-current="page">List</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
  <div class="row">
    <x-toast />
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">List Data Blog</h4>
          <div class="table-responsive">
            <table class="table table-hover table-compact" id="blogTable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">
                    <div class="d-flex flex-column">
                      <span>Domain</span>
                      <span>Provider - Status</span>
                    </div>
                  </th>
                  <th scope="col">
                    <div class="d-flex flex-column">
                      <span>Topic</span>
                      <span>Language</span>
                    </div>
                  </th>
                  <th scope="col">
                    <div class="d-flex flex-column">
                      <span>DA</span>
                      <span>DR</span>
                    </div>
                  </th>
                  <th scope="col">Traffic</th>
                  <th scope="col">PIC</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                @foreach ($blogs as $blog)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      <div class="d-flex flex-column gap-1">
                        <a href="{{ $blog->domain }}" class="text-decoration-underline">{{ $blog->domain }}</a>
                        <span>
                          <span class="badge bg-success">{{ $blog->provider?->name }}</span>
                          <span class="badge bg-primary">{{ $blog->status }}</span>
                        </span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column align-items-start gap-1">
                        <span>{{ $blog->topic?->name }}</span>
                        <span class="badge bg-secondary">{{ $blog->lang }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-column gap-1">
                        <span>{{ $blog->domain_authority }}</span>
                        <span>{{ $blog->domain_rating }}</span>
                      </div>
                    </td>
                    <td>{{ $blog->traffic_views }}</td>
                    <td>{{ $blog->pic }}</td>
                    <td class="d-flex flex-column align-items-center gap-2">
                      <a href="{{ route('blog.edit', $blog) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $blog->id }}"
                        data-bs-toggle="modal" data-bs-target="#primary-header-modal">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-delete-modal />
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
  <script src="{{ asset('src/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script>
    $('#blogTable').DataTable({
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.delete-btn').on('click', function() {
        var id = $(this).data('id');
        var formAction = "{{ route('blog.destroy', ':id') }}";
        formAction = formAction.replace(':id', id);

        $('#deleteForm').attr('action', formAction);
        $('#primary-header-modal').modal('show');
      });
    });

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
