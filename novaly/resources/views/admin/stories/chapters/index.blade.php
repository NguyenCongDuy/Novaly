@extends('layouts.AdminLayout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Danh sách chương của truyện: {{ $story->title }}</h5>
                    <a href="{{ route('admin.stories.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back"></i> Quay lại truyện
                    </a>
                </div>
                <a href="{{ route('admin.stories.chapters.create', $story->id) }}" class="btn btn-primary">
                    Thêm chương
                </a>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Số chương</th>
                                <th>Tiêu đề</th>
                                <th>Loại truy cập</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0">
                            @forelse ($chapters as $chapter)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($chapters->currentPage() - 1) * $chapters->perPage() }}
                                    </td>
                                    <td>{{ $chapter->chapter_number }}</td>
                                    <td>{{ $chapter->title }}</td>
                                    <td>
                                        @if ($chapter->access_type === 'free')
                                            <span class="badge bg-success">Free</span>
                                        @elseif ($chapter->access_type === 'coin')
                                            <span class="badge bg-warning text-dark">Coin</span>
                                        @elseif ($chapter->access_type === 'premium')
                                            <span class="badge bg-primary">Premium</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($chapter->access_type) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                {{-- sửa --}}
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.stories.chapters.edit', [$story->id, $chapter->id]) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Sửa
                                                </a>

                                                {{-- xóa --}}
                                                <form
                                                    action="{{ route('admin.stories.chapters.destroy', [$story->id, $chapter->id]) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa chương này?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bx bx-trash me-1"></i> Xóa
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted mb-0">Chưa có chương nào</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $chapters->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
