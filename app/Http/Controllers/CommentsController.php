<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(CommentRequest $request, $gallery_id)
    {
        return Comment::addComment($request, $gallery_id);
    }


    public function destroy(Comment $comment)
    {
        //
    }
}
