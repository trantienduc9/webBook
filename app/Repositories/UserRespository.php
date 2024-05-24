<?php
namespace App\Repositories;

use App\Models\User;

class UserRespository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function usercomfirm()
    {
        return User::where('trang_thai', 0)->get();
    }
    public function usergetwhereid($id)
    {
        return User::where('id',"<>",$id)->get();
    }
}
