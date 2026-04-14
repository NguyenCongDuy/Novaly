@extends('layouts.AdminLayout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            {{-- Header --}}
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Quản lý Truyện</h5>
                <a href="{{ route('admin.stories.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Thêm mới
                </a>
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Table --}}
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh Truyện</th>
                            <th>Tên Truyện</th>
                            <th>Tác Giả</th>
                            {{-- <th>Genres</th> --}}
                            <th>Trạng Thái</th>
                            <th>Ngày Tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">
                        @forelse ($stories as $story)
                            <tr>
                                {{-- STT --}}
                                <td>
                                    {{ $loop->iteration + ($stories->currentPage() - 1) * $stories->perPage() }}
                                </td>

                                {{-- Avatar --}}
                                <td>
                                    @if($story->avatar_url)
                                        <img src="{{ asset('storage/' . $story->avatar_url) }}" alt="{{ $story->title }}" class="rounded" width="50" height="50">
                                    @else
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default" class="rounded" width="50" height="50">
                                    @endif
                                </td>

                                {{-- Title --}}
                                <td>
                                    <strong>{{ $story->title }}</strong>
                                </td>

                                {{-- Author --}}
                                <td>
                                    {{ $story->author?->name ?? '—' }}
                                </td>

                                {{-- Genres --}}
                                {{-- <td>
                                    @foreach($story->genres as $genre)
                                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                                    @endforeach
                                </td> --}}

                                {{-- Status --}}
                                <td>
                                    @if($story->status)
                                        <span class="badge bg-success">Publish</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>

                                {{-- Created --}}
                                <td>
                                    {{ $story->created_at->format('d/m/Y H:i') }}
                                </td>

                                {{-- Actions --}}
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.stories.show', $story->id) }}">
                                                <i class="bx bx-show me-1"></i> Xem chi tiết
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.stories.edit', $story->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Sửa
                                            </a>

                                            <form action="{{ route('admin.stories.destroy', $story->id) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Bạn chắc chắn muốn xóa truyện này?');">
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
                                <td colspan="10" class="text-center py-4">
                                    <p class="text-muted">Chưa có dữ liệu</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $stories->links() }}
            </div>

        </div>
    </div>
</div>
@endsection