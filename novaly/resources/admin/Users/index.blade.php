@extends('layouts.AdminLayout')
@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Danh sách Tin Tức</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Ngày đăng</th>
                <th>Trích đoạn nội dung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tinTucs as $key => $tinTuc)
               
            @endforeach
        </tbody>
    </table>
</div>
{{ $nhanViens->links() }}
@endsection