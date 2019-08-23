<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $primaryKey="id";

    protected $fillable = ['post_id','user_id','content'];
    
    public function post(){
        return  $this->belongsTo('\App\Post','post_id');
    }
}
