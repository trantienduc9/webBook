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
            margin-top: 5%;
        }

        .login-container {
            margin-top: 20px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-table th,
        .custom-table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #ddd;
        }

        .custom-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .custom-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .custom-table img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .btn-view {
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-view:hover {
            background-color: #218838;
        }

        /* Responsive CSS for small screens */
        @media (max-width: 768px) {

            .custom-table td,
            .custom-table th {
                padding: 8px;
                font-size: 14px;
            }

            .custom-table img {
                max-width: 60px;
            }
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

    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container login-container">
        <div class="table-responsive">
            <table class="custom-table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Ngày mua</th>
                        <th>Xem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_bought as $item)
                        <tr>
                            <td>
                                @if(isset($item->URL))
                                    <img src="{{ asset($item->URL) }}" class="img-thumbnail" width="150px" alt="">
                                @endif
                            </td>
                            <td>{{$item->TenSach}}</td>
                            <td>{{$item->TacGia}}</td>
                            <td>{{$item->Gia}}</td>
                            <td>{{ isset($item->SoLuong) ? $item->SoLuong : '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                            <td><a class="btn-view" href="{{ route('detail', ['id' => $item['ID_Sach']]) }}">Xem</a></td>
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
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                        "first": "Trang đầu",
                        "last": "Trang cuối"
                    }
                },
                "pageLength": 5
            });
        });
    </script>
@stop
