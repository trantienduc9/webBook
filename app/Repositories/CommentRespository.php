<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRespository extends BaseRepository
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }
}
