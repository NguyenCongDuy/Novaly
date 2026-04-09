@extends('layouts.AdminLayout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Quản lý Thể loại</h5>
                <a href="{{ route('admin.genres.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Thêm mới
                </a>
            </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên thể loại</th>
                                <th>Slug</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($genres as $genre)
                                <tr>
                                    <td>{{ $loop->iteration + ($genres->currentPage() - 1) * $genres->perPage() }}</td>
                                    <td>
                                        <strong>{{ $genre->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $genre->slug }}</span>
                                    </td>
                                    <td>
                                        {{ $genre->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.genres.edit', $genre->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Sửa
                                                </a>
                                                <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa thể loại này?');">
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
                                        <p class="text-muted">Chưa có dữ liệu</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $genres->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
