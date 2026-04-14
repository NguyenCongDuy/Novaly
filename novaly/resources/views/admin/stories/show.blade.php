@extends('layouts.AdminLayout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Chi tiết Truyện</h5>
                <div>
                    <a href="{{ route('admin.stories.edit', $story->id) }}" class="btn btn-primary me-2">
                        <i class="bx bx-edit"></i> Chỉnh sửa
                    </a>
                    <a href="{{ route('admin.stories.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Story Info -->
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-4">
                        <div class="text-center mb-4">
                            @if($story->cover_url)
                                <img src="{{ asset('storage/' . $story->cover_url) }}" alt="{{ $story->title }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                                    <i class="bx bx-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif

                            @if($story->avatar_url)
                                <img src="{{ asset('storage/' . $story->avatar_url) }}" alt="Avatar" class="rounded-circle mb-2" width="80" height="80">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="rounded-circle mb-2" width="80" height="80">
                            @endif

                            @if($story->status == 1)
                                <span class="badge bg-success fs-6">Publish</span>
                            @else
                                <span class="badge bg-secondary fs-6">Draft</span>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-3">{{ $story->title }}</h2>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <strong>Tác giả:</strong> {{ $story->author->name ?? 'N/A' }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Ngày tạo:</strong> {{ $story->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <strong>Lượt xem:</strong> {{ number_format($story->view_count) }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Lượt thích:</strong> {{ number_format($story->like_count) }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Thể loại:</strong>
                            @forelse($story->genres as $genre)
                                <span class="badge bg-primary me-1">{{ $genre->name }}</span>
                            @empty
                                <span class="text-muted">Chưa có thể loại</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="fw-bold mb-3">Mô tả</h5>
                        <div class="bg-light p-3 rounded">
                            @if($story->description)
                                <p class="mb-0">{{ nl2br(e($story->description)) }}</p>
                            @else
                                <p class="text-muted mb-0">Chưa có mô tả</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Chapters -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="fw-bold mb-3">Danh sách chương ({{ $story->chapters->count() }})</h5>
                        @if($story->chapters->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tiêu đề</th>
                                            <th>Ngày tạo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($story->chapters as $chapter)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $chapter->title }}</td>
                                                <td>{{ $chapter->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 bg-light rounded">
                                <p class="text-muted mb-0">Chưa có chương nào</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection