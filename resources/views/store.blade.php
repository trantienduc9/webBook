@extends('admin.default')

@section('title')
    Test
    @parent
@stop

@section('header_styles')
    <!-- Thêm các tài nguyên CSS của bạn tại đây -->
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container mt-5">
        <h2 class="mb-4">Thêm Sản Phẩm</h2>
        <form method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
            <input type="text" name="id_book" value="{{isset($books['id']) ? $books['id'] : ''}}" hidden>
            @csrf
            <div class="form-group">
                <label for="productName">Tên Sách:</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Nhập tên sách"
                    value="{{ isset($books['TenSach']) ? $books['TenSach'] : '' }}">
            </div>
            <div class="form-group">
                <label for="author">Tác Giả:</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Nhập tên tác giả"
                    value="{{ isset($books['TacGia']) ? $books['TacGia'] : '' }}">
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sách"
                    value="{{ isset($books['Gia']) ? $books['Gia'] : '' }}">
            </div>
            <div class="form-group">
                <label for="quantity">Số Lượng:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng sách"
                    value="{{ isset($books['SoLuongTrongKho']) ? $books['SoLuongTrongKho'] : '' }}">
            </div>
            <div class="form-group">
                <label for="quantity">Thể loại:</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="" hidden>--Chọn thể loại--</option>
                    @foreach ($list_category as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($books['id_category']) && $item->id == $books['id_category'] ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả:</label>
                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Nhập mô tả sách">{{ isset($books['MoTa']) ? $books['MoTa'] : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Ảnh Sách:</label>
                <input type="file" class="form-control-file" name="image" id="image" onchange="previewImage()">
                <div id="display_image">
                    @if(isset($books["URL"]))
                        <img src="{{ asset($books["URL"]) }}" width="100px" alt="">
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{isset($books['id'])? 'Cập nhật' : 'Thêm Sản Phẩm' }} </button>
        </form>
    </div>
@stop

@section('footer_scripts')
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script type="text/javascript"></script>
@stop
