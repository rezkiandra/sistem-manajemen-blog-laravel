@extends('layouts.app')
@section('title', 'List Adsense')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Adsense') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Adsense</li>
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
          <h4 class="card-title">List Data Adsense</h4>
          <div class="table-responsive">
            <table class="table table-hover" id="adsTable">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Domain</th>
                  <th scope="col">Email</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                @foreach ($adsenses as $adsense)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
											<a href="{{ $adsense->domain }}" class="text-decoration-underline">{{ $adsense->domain }}</a>
										</td>
                    <td>{{ $adsense->email }}</td>
                    <td>{{ $adsense->status }}</td>
                    <td class="d-flex align-items-center gap-2">
                      <a href="{{ route('adsense.edit', $adsense) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $adsense->id }}"
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
    $('#adsTable').DataTable({
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
        var formAction = "{{ route('adsense.destroy', ':id') }}";
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
