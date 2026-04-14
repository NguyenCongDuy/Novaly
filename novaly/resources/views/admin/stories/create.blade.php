@extends('layouts.AdminLayout')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">

            {{-- Header --}}
            <div class="card-header">
                <h5 class="card-title">Thêm Truyện mới</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.stories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tiêu đề --}}
                    <div class="mb-3">
                        <label class="form-label" for="title">
                            Tiêu đề <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Nhập tiêu đề truyện">

                        @error('title')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="mb-3">
                        <label class="form-label" for="slug">Slug (Tùy chọn)</label>
                        <input type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            placeholder="Slug sẽ tự động tạo từ tiêu đề">

                        <small class="form-text text-muted">
                            Để trống nếu muốn tự động tạo từ tiêu đề
                        </small>

                        @error('slug')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mô tả --}}
                    <div class="mb-3">
                        <label class="form-label" for="description">Mô tả</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="3"
                            placeholder="Nhập mô tả">{{ old('description') }}</textarea>

                        @error('description')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tác giả --}}
                    <div class="mb-3">
                        <label class="form-label" for="author_id">Tác giả</label>
                        <select
                            class="form-select @error('author_id') is-invalid @enderror"
                            id="author_id"
                            name="author_id">
                            
                            <option value="">-- Chọn tác giả --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('author_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Thể loại --}}
                    <div class="mb-3">
                        <label class="form-label" for="genre_ids">Thể loại</label>
                        <div class="row">
                            @foreach($genres as $genre)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="genre_{{ $genre->id }}" name="genre_ids[]" value="{{ $genre->id }}"
                                            {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="genre_{{ $genre->id }}">
                                            {{ $genre->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @error('genre_ids')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Avatar --}}
                    <div class="mb-3">
                        <label class="form-label" for="avatar">Avatar</label>
                        <input type="file"
                            class="form-control @error('avatar') is-invalid @enderror"
                            id="avatar"
                            name="avatar"
                            accept="image/*">

                        <small class="form-text text-muted">
                            Chọn file ảnh (JPEG, PNG, JPG, GIF) tối đa 2MB
                        </small>

                        @error('avatar')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Cover --}}
                    <div class="mb-3">
                        <label class="form-label" for="cover">Cover</label>
                        <input type="file"
                            class="form-control @error('cover') is-invalid @enderror"
                            id="cover"
                            name="cover"
                            accept="image/*">

                        <small class="form-text text-muted">
                            Chọn file ảnh (JPEG, PNG, JPG, GIF) tối đa 5MB
                        </small>

                        @error('cover')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Trạng thái --}}
                    <div class="mb-3">
                        <label class="form-label" for="status">
                            Trạng thái <span class="text-danger">*</span>
                        </label>
                        <select
                            class="form-select @error('status') is-invalid @enderror"
                            id="status"
                            name="status">

                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                Publish
                            </option>
                        </select>

                        @error('status')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bx bx-check"></i> Lưu
                        </button>

                        <a href="{{ route('admin.stories.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Quay lại
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection