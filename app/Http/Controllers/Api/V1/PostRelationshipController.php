<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;

class PostRelationshipController extends Controller
{
    //? Para obtener la url- self (route)
    public function author(Post $post){
        return new UserResource($post->author);
    }

    public function comments(Post $post){
        return CommentResource::collection($post->comments);
    }
}
