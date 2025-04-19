@extends('layouts.admin')
@section('title', 'Terms & Conditions')
@push('styles')

@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>📄 Edit Terms & Conditions</h4>
      <button class="btn btn-outline-secondary">⏪ Back to CMS</button>
    </div>
  
    <form class="card-body row g-4" method="POST">
      @csrf
  
      <!-- Title -->
      <div class="col-12">
        <label class="form-label">📝 Title *</label>
        <input type="text" name="title" class="form-control" placeholder="e.g., Terms & Conditions" required>
      </div>
  
      <!-- Full Content / Description -->
      <div class="col-12">
        <label class="form-label">📜 Full Content *</label>
        <!-- Replace with WYSIWYG like CKEditor/TinyMCE -->
        <textarea name="content" class="form-control wysiwyg-editor" rows="10" placeholder="Enter terms and conditions..." required></textarea>
      </div>
  
      <!-- SEO Section -->
      <hr class="mt-4">
      <h5>🔍 SEO Meta Info</h5>
  
      <div class="col-md-6">
        <label class="form-label">Meta Title</label>
        <input type="text" name="meta_title" class="form-control" placeholder="Page SEO title">
      </div>
  
      <div class="col-md-6">
        <label class="form-label">Meta Description</label>
        <input type="text" name="meta_description" class="form-control" placeholder="Short meta description">
      </div>
  
      <div class="col-12">
        <label class="form-label">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control" placeholder="terms, policy, usage, agreement">
      </div>
  
      <!-- Submit -->
      <div class="col-12 d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-success">💾 Save Changes</button>
        <button type="reset" class="btn btn-outline-secondary ms-2">Cancel</button>
      </div>
    </form>
  </div>
  
  @endsection
  
  @push('scripts')
  <script>
    ClassicEditor.create(document.querySelector('.wysiwyg-editor'))
      .catch(error => console.error(error));
  </script>
  
  @endpush  