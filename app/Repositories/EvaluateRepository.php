<?php
namespace App\Repositories;

use App\Models\Evaluate;

class EvaluateRepository extends BaseRepository
{
    public function __construct(Evaluate $evaluate)
    {
        parent::__construct($evaluate);
    }

    public function findByEvaluate($idbook)
    {
        return Evaluate::where('id_book', $idbook)->get();
    }
    public function checkEvaluate($iduser, $idbook)
    {
        return Evaluate::where('id_user', $iduser)->where('id_book', $idbook)->first();
    }

    public function updatecheckEvaluate($iduser, $idbook, $data)
    {
        return Evaluate::where('id_user', $iduser)->where('id_book', $idbook)->update($data);
    }

}
