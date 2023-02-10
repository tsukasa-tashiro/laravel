<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    public function like(){
        return $this->belongsTO('App\Like');
    }

    public function camera(){
        return $this->hasOne('App\Camera');
    }

    public function lens(){
        return $this->hasOne('App\Lens');
    }

    // use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'image1',
    ];
}
