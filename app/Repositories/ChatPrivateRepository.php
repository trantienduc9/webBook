<?php

namespace App\Repositories;

use App\Models\ChatPrivate;

class ChatPrivateRepository extends BaseRepository
{
    public function __construct(ChatPrivate $ChatPrivate)
    {
        parent::__construct($ChatPrivate);
    }

    public function findByChatPrivate($idsend, $idsent)
    {
        return ChatPrivate::where(function ($query) use ($idsend, $idsent) {
            $query->where('id_send', $idsend)
                ->where('id_sent', $idsent);
        })->orWhere(function ($query) use ($idsend, $idsent) {
            $query->where('id_send', $idsent)
                ->where('id_sent', $idsend);
        })->first();
    }
}
