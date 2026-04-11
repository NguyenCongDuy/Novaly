@extends('layouts.AdminLayout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Quản lý Tác giả</h5>
                    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Thêm mới
                    </a>
                </div>

                {{-- Thông báo --}}
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
                                <th>#</th>
                                <th>Tên tác giả</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($authors as $author)
                                <tr>
                                    {{-- STT có phân trang --}}
                                    <td>
                                        {{ $loop->iteration + ($authors->currentPage() - 1) * $authors->perPage() }}
                                    </td>

                                    <td>
                                        <strong>{{ $author->name }}</strong>
                                    </td>

                                    <td>
                                        {{ $author->date ? \Carbon\Carbon::parse($author->date)->format('d/m/Y') : '—' }}
                                    </td>

                                    <td>
                                        {{ $author->address ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $author->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.authors.edit', $author->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Sửa
                                                </a>

                                                <form action="{{ route('admin.authors.destroy', $author->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa tác giả này?');">
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
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted">Chưa có dữ liệu</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $authors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
