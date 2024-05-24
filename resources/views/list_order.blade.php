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
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ nhận hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>Ngày đặt hàng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td><img src="{{ isset($item->book->URL) ? asset($item->book->URL) : '' }}" class="img-thumbnail" width="80px" alt=""></td>
                            <td>{{ isset($item->customer->Ten) ? $item->customer->Ten : '' }}</td>
                            <td>{{ isset($item->customer->DiaChi) ? $item->customer->DiaChi : ''}}</td>
                            <td>{{ isset($item->customer->Email) ? $item->customer->Email : '' }}</td>
                            <td>{{ isset($item->customer->SoDienThoai) ? $item->customer->SoDienThoai : ''  }}</td>
                            <td>{{ $item->SoLuong }}</td>
                            <td>{{ $item->Gia }}</td>
                            <td>{{ $item->trang_thai }}</td>
                            <td>{{ isset($item->customer->ghi_chu) ? $item->customer->ghi_chu : '' }}</td>
                            <td>{{ isset($item->customer->created_at) ? \Carbon\Carbon::parse($item->customer->created_at)->format('d-m-Y H:i:s') : '' }}</td>
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
                "pagingType": "full_numbers", // Sử dụng kiểu phân trang đơn giản
                "lengthMenu": [8], // Chỉ hiển thị 8 hàng trên mỗi trang
                "language": {
                    "paginate": {
                        "previous": "<", // Thay đổi nút trang trước thành dấu <
                        "next": ">" // Thay đổi nút trang sau thành dấu >
                    }
                }
            });
        });
    </script>
@stop
