@extends('layouts.AdminLayout')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm Thể loại mới</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.genres.store') }}" method="POST">
                    @csrf
                    <!-- Tên thể loại -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Tên thể loại <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên thể loại">
                        @error('name')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label class="form-label" for="slug">Slug (Tùy chọn)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                            id="slug" name="slug" value="{{ old('slug') }}" placeholder="Slug sẽ tự động tạo từ tên">
                        <small class="form-text text-muted">Để trống nếu muốn tự động tạo từ tên</small>
                        @error('slug')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bx bx-check"></i> Lưu
                        </button>
                        <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
