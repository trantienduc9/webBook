@extends('admin.default')

@section('title')
    Test
    @parent
@stop

@section('header_styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase; /* Chuyển đổi chữ hoa */
            font-size: 14px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            text-transform: uppercase; /* Chuyển đổi chữ hoa */
            font-size: 12px;
            font-weight: bold;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-info {
            background-color: #007bff;
            color: #fff;
        }

        .btn-info:hover {
            background-color: #0056b3;
        }

        /* Responsive CSS for small screens */
        @media (max-width: 768px) {

            .table td,
            .table th {
                padding: 8px;
                font-size: 14px;
            }

            .table img {
                max-width: 60px;
            }
        }
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container login-container">
        <div class="table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Tài khoản</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comfirm as $item)
                        <tr class="comfirm_{{$item->id}}">
                            <td><img src="{{ asset($item->URL) }}" class="img-thumbnail" width="80px" alt=""></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td class="">
                                <button type="button" onclick="comfirm({{ $item->id }},1, '{{$item->email}}')" class="btn btn-danger">Xác
                                    nhận</button>
                                <button type="button" onclick="comfirm({{ $item->id }},2, '{{$item->email}}')" class="btn btn-info">Từ
                                    chối</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('footer_scripts')
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script type="text/javascript">
            // Khởi tạo DataTable ban đầu và gán vào biến table
            var table = $('#myTable').DataTable({
                "paging": false, // Tắt phân trang
                "searching": false, // Tắt thanh tìm kiếm

            });

            // Hàm xác nhận
            function comfirm(id, check_comfirm, email) {
                $(".comfirm_"+id).remove();
                fetch('comfirm_acc', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                        },
                        body: JSON.stringify({
                            // Dữ liệu bạn muốn gửi đi (nếu cần)
                            id: id,
                            check_comfirm: check_comfirm,
                            email: email,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data != 0) {
                            // Load lại DataTable
                            // location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                    });
            }
    </script>
@stop
