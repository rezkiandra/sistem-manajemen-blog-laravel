<div class="modal fade" id="primary-header-modal" tabindex="-1" aria-labelledby="primary-header-modalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-colored-header bg-primary">
        <h4 class="modal-title" id="primary-header-modalLabel">Konfirmasi Hapus</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <h5 class="mt-0">Apakah Anda yakin ingin menghapus data ini?</h5>
        <p>Data yang dihapus tidak dapat dikembalikan.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
