<?php
namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OderRepository extends BaseRepository
{
    public function __construct(Order $oder)
    {
        parent::__construct($oder);
    }

    public function findByOder($id_user)
    {
        return $this->model
                ->leftJoin('books', 'books.id', '=', 'orders.ID_Sach')
                ->where('orders.id_user', $id_user) // Sử dụng auth() thay vì Auth::
                ->select('orders.SoLuong','orders.ID_Sach','orders.created_at','books.TenSach','books.Gia','books.TacGia','books.URL') // Chọn tất cả cột từ cả hai bảng
                ->get();
    }
}
