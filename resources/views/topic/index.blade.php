@extends('layouts.app')
@section('title', 'List Topic')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Topic') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Topic</li>
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
          <h4 class="card-title">List Data Topic</h4>
          <div class="table-responsive">
            <table class="table table-hover table-compact" id="topicTable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                @foreach ($topics as $topic)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $topic->name }}</td>
                    <td class="d-flex align-items-center gap-2">
                      <a href="{{ route('topic.edit', $topic) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $topic->id }}"
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
    $('#topicTable').DataTable({
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
        var formAction = "{{ route('topic.destroy', ':id') }}";
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
