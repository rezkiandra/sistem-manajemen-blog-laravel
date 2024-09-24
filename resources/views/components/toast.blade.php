@if (session('success'))
  <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast fade show mb-3" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">
          <i class="fas fa-bell text-primary me-1"></i>
          Notifikasi
        </strong>
        <small class="text-muted">{{ Carbon\Carbon::now()->locale('id')->diffForHumans() }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ session('success') }}
      </div>
    </div>
  </div>
@endif
