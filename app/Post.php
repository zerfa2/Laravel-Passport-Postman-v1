<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $primaryKey="id";

    protected $fillable = ['author_id','title','content'];

    public function comments(){
        return $this->hasMany(Comment::class,'post_id');
    }
        
    public function author(){
        return $this->belongsTo('\App\User','author_id');
    }
}
