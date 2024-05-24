<?php
namespace App\Repositories;

use App\Models\PrivateMessage;

class PrivateMessageRepository extends BaseRepository
{
    public function __construct(PrivateMessage $PrivateMessage)
    {
        parent::__construct($PrivateMessage);
    }

}
