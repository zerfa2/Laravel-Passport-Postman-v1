<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $user = Auth::user();

        return [
            'type'=>$this->getTable(),
            'id'=> $this->id,
            "attributes"=>[
                'title'=>$this->title,
                'content'=>$this->content
            ],

            //? mergeWhen heredados de la clase JsonResource
            //! $this->mergeWhen($user->isAdmin(),[
            //!    'created' => $this->created_at
            //! ]),
            $this->mergeWhen(($this->isAuthorLoaded() && $this->isCommentsLoaded()),[
                'relationships'=> new PostRelationshipResource($this)

            ]),

            // "relationships"=> new PostRelationshipResource($this),

            "links"=>[
                'self'=>route('posts.show',["post"=>$this->id])
            ],
        //    [
        //         "author"=> [],
        //         "comments"=>[]
        //     ] 
        ];
    }
}
