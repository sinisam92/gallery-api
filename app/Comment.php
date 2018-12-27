<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'gallery_id',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public static function addComment($request , $gallery_id) {


        $user = auth()->user()->id;
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->gallery_id = $gallery_id;
        $comment->user_id = $user;
        $comment->save();

        return Comment::with('user')->where('id', $comment->id)->get();
        
       
    }
}
