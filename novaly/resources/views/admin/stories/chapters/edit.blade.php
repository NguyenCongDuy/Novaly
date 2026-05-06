@extends('layouts.AdminLayout')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Chỉnh sửa chương {{ $chapter->chapter_number }} của truyện: {{ $story->title }}</h5>
                <a href="{{ route('admin.stories.chapters.index', $story->id) }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Quay lại danh sách chương
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.stories.chapters.update', [$story->id, $chapter->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Chapter number --}}
                    <div class="mb-3">
                        <label class="form-label">Số chương</label>
                        <input type="text" class="form-control" value="{{ $chapter->chapter_number }}" disabled>
                    </div>

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label" for="title">
                            Tiêu đề chương <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $chapter->title) }}"
                            placeholder="Nhập tiêu đề chương">

                        @error('title')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Access Type --}}
                    <div class="mb-3">
                        <label class="form-label" for="access_type">
                            Loại truy cập <span class="text-danger">*</span>
                        </label>
                        <select id="access_type"
                            name="access_type"
                            class="form-select @error('access_type') is-invalid @enderror">
                            <option value="">-- Chọn loại truy cập --</option>
                            <option value="free" {{ old('access_type', $chapter->access_type) === 'free' ? 'selected' : '' }}>Free</option>
                            <option value="coin" {{ old('access_type', $chapter->access_type) === 'coin' ? 'selected' : '' }}>Coin</option>
                            <option value="premium" {{ old('access_type', $chapter->access_type) === 'premium' ? 'selected' : '' }}>Premium</option>
                        </select>

                        @error('access_type')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Coin price --}}
                    <div class="mb-3" id="coin_price_group" style="display: none;">
                        <label class="form-label" for="coin_price">Giá coin</label>
                        <input type="number"
                            step="0.01"
                            min="0"
                            class="form-control @error('coin_price') is-invalid @enderror"
                            id="coin_price"
                            name="coin_price"
                            value="{{ old('coin_price', $chapter->coin_price) }}"
                            placeholder="Nhập số coin nếu truy cập coin">

                        @error('coin_price')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Money price --}}
                    <div class="mb-3" id="money_price_group" style="display: none;">
                        <label class="form-label" for="money_price">Giá tiền</label>
                        <input type="number"
                            step="0.01"
                            min="0"
                            class="form-control @error('money_price') is-invalid @enderror"
                            id="money_price"
                            name="money_price"
                            value="{{ old('money_price', $chapter->money_price) }}"
                            placeholder="Nhập giá tiền nếu truy cập premium">

                        @error('money_price')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Content --}}
                    <div class="mb-3">
                        <label class="form-label" for="content">Nội dung chương</label>
                        <textarea
                            id="content"
                            name="content"
                            rows="10"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Nhập nội dung chương">{{ old('content', optional($chapter->content)->content) }}</textarea>

                        @error('content')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <p class="text-muted mb-0">
                            Số chương không thể chỉnh sửa. Các giá trị giá sẽ được cập nhật theo loại truy cập.
                        </p>
                    </div>

                    {{-- Buttons --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bx bx-check"></i> Cập nhật chương
                        </button>
                        <a href="{{ route('admin.stories.chapters.index', $story->id) }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const accessType = document.getElementById('access_type');
        const coinPriceGroup = document.getElementById('coin_price_group');
        const moneyPriceGroup = document.getElementById('money_price_group');

        function togglePriceFields() {
            const value = accessType.value;
            coinPriceGroup.style.display = value === 'coin' ? 'block' : 'none';
            moneyPriceGroup.style.display = value === 'premium' ? 'block' : 'none';
        }

        accessType.addEventListener('change', togglePriceFields);
        togglePriceFields();
    });
</script>
@endpush
