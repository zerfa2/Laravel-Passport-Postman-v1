<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCommentsRelationshipCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $post = $this->additional["post"];

        return [
            "links"=>[
                "self"=>route('post.relationships.comments',['post'=>$post]),
                "related"=>route('post.comments',['post'=>$post])
            ],
            "data"=> CommentIdentifierResource::collection($this->collection)
        ];
    }
}
