<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public static function getGalleries($request, $user = null) 
    {
        $page = $request['page'];
        $term = $request['term'];

        $query = Gallery::query();
        $query->with('user', 'images');

        if($user) {
            $query->where('user_id', $user);
        }

        if($term) {
            $query->where(function($que) use ($term){
                $que->where('title', 'like', '%'.$term.'%')
                  ->orWhere('description','like', '%'.$term.'%')
                  ->orWhereHas('user', function($q) use ($term){
                      $q->where('first_name', 'like', '%'.$term.'%')
                        ->orWhere('last_name','like', '%'.$term.'%');
                  });
                });
        }
        $count = $query->count();

        $galleries = $query->skip(($page-1) * 10)
                            ->take(10)
                            ->orderBy('created_at','desc')
                            ->get();
        return compact("galleries", "count");
    }

    public static function getSingleGallery($id) 
    {
        return Gallery::with('user', 'images', 'comments.user')
                        ->findOrFail($id);
    }
}
