<?php

namespace App\Http\Resources;

use App\User;
use App\Comment;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data"=> PostResource::collection($this->collection)
        ];
    }
    //? Con with add al json, datas
    public function with($request)
    {
        // USamos map para q interactue con los elements
        $authors= $this->collection->map(function($post){
            return $post->author;
        });

        // $comments = $this->collection->map(function($post){
        //     return $post->comments;
        // });
        $comments = $this->collection->flatMap(function($post){
            return $post->comments;
        });

        $include = $authors->merge($comments);
            // dd($include);

        return [
            'links'=>[
                'name'=>"deybis",
                'self'=> route('posts.index')
            ],
            // 'included'=> $authors->map(function($item){
            //         return new UserResource($item);
            // })

            'included'=> $include->map(function($item){
                if($item instanceof User){
                    return new UserResource($item);
                }else if($item instanceof Comment){
                    return new CommentResource($item);

                }
            })
        ];
    }
}
