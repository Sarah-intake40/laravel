<?php

namespace App\Http\Resources;

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
        return ['Title'=>$this->title,
                 'Description'=>$this->description,
                 'Owner detail'=>['id'=>$this->user?$this->user->id:'not exist',
                               'Owner Name'=>$this->user->name,
                               'email'=>$this->user->email]];
    }
}
