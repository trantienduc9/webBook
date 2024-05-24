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

        /* DataTables CSS */
        .dataTables_wrapper {
            margin-top: 20px;
            padding: 20px;
        }

        .dataTables_wrapper .dataTables_filter input[type="search"] {
            width: 300px;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            transition: border-color 0.3s;
        }

        .dataTables_wrapper .dataTables_filter input[type="search"]:focus {
            outline: none;
            border-color: #007bff;
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
                    @foreach ($list_acc as $item)
                        <tr>
                            <td><img src="{{ asset($item->URL) }}" class="img-thumbnail" width="80px" alt=""></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td class="">
                                <a href="" class="btn btn-danger">Xóa</a>
                                <a href="{{ route('signup') }}?check=2&id={{ $item['id'] }}" class="btn btn-info">Chỉnh sửa</a>
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
        $(document).ready(function() {
            $('#myTable').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [8], // Chỉ hiển thị 8 hàng trên mỗi trang
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });
        });
    </script>
@stop
