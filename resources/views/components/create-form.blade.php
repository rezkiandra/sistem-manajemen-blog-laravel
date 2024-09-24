<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  <div class="form-body">
    <div class="row">
      {{ $slot }}
    </div>
  </div>

  <x-button :title="__('Submit')" :type="'submit'" :class="'primary me-2'" :icon="'save'" />
  <x-button :title="__('Reset')" :type="'reset'" :class="'dark'" :icon="'undo'" />
</form>
