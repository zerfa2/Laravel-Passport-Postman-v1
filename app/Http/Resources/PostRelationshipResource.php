<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            "author"=>[
                "links"=>[
                    "self"=> route('post.relationships.author', ["post"=>$this->id]),
                    "related"=> route('post.author',['post'=>$this->id]),
                ],
                // "data"=>[
                //     'type'=>$this->author->getTable(),
                //     'id'=>$this->author->id
                // ]
                "data"=>new AuthorIdentifierResource($this->author)
            ],
            // Aqui cree una coleccion por los all comments q pertenecen a un Post
            "comments"=>(new PostCommentsRelationshipCollection($this->comments))->additional(["post"=>$this])
        ];
    }
}
