<?php
namespace App\Repositories;

use App\Models\RoleUser;

class RoleUserRespository extends BaseRepository
{
    public function __construct(RoleUser $roleuser)
    {
        parent::__construct($roleuser);
    }
}
