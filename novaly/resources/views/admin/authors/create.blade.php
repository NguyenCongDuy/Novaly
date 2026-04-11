@extends('layouts.AdminLayout')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thêm Tác giả mới</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.authors.store') }}" method="POST">
                        @csrf

                        {{-- Tên tác giả --}}
                        <div class="mb-3">
                            <label class="form-label" for="name">
                                Tên tác giả <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Nhập tên tác giả">

                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Ngày sinh --}}
                        <div class="mb-3">
                            <label class="form-label" for="date">Ngày sinh</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                name="date" value="{{ old('date') }}">

                            @error('date')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Địa chỉ --}}
                        <div class="mb-3">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address') }}" placeholder="Nhập địa chỉ">

                            @error('address')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-3">
                            <label class="form-label" for="description">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3" placeholder="Nhập mô tả">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tiểu sử --}}
                        <div class="mb-3">
                            <label class="form-label" for="bio">Tiểu sử</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4"
                                placeholder="Nhập tiểu sử">{{ old('bio') }}</textarea>

                            @error('bio')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="bx bx-check"></i> Lưu
                            </button>

                            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back"></i> Quay lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
