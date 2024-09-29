@extends('layouts.app')
@section('title', 'Edit Blog Keyword')
@section('header')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ __('Blog Keyword') }}</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item">Data Blog Keyword</li>
              <li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">{{ __('Edit Data Blog Keyword') }}</h4>

          <x-error-handling />
          <x-create-form :action="route('blog-keyword.update', $blogKeyword)">
            @csrf
            @method('PUT')
            <x-input-label :label="'Domain'" :name="'blog_id'" :type="'select'" :placeholder="'Pilih domain'" :options="$blogs" :field="'domain'" :value="$blogKeyword->blog_id" />
            <div class="col-md-12">
              <div class="form-group mb-4">
                <label class="form-label">Keyword</label>
                <select name="keyword[][]" id="keyword" class="form-select select2" multiple>
                  @foreach ($allKeywords as $id => $option)
                    <option value="{{ $option }}"
                      {{ in_array(trim($option), array_column($keywords, 0)) ? 'selected' : '' }}>
                      {{ $option }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </x-create-form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2({
        placeholder: 'Pilih keyword',
        allowClear: true,
        multiple: true
      });
    });
  </script>
@endpush
