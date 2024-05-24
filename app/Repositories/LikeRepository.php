<?php

namespace App\Repositories;

use App\Models\Like;

class LikeRepository extends BaseRepository
{
    public function __construct(Like $like)
    {
        parent::__construct($like);
    }

    public function findByLike($iduser)
    {
        return Like::where('id_user', $iduser)->get();
    }
    public function checkLike($iduser, $idbook)
    {
        return Like::where('id_user', $iduser)->where('id_book', $idbook)->first();
    }
    public function deletewhere($iduser, $idbook)
    {
        return Like::where('id_user', $iduser)->where('id_book', $idbook)->delete();
    }
}
