<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Like;

class Post extends Model
{
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //後でViewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }

    public function camera(){
        return $this->hasOne('App\Camera');
    }

    public function lens(){
        return $this->hasOne('App\Lens');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id'); 
    }

    // use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'image1',
    ];
}
