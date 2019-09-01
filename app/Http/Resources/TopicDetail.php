<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\User;

class TopicDetail extends JsonResource
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
          'id'           => $this->id,
          'name'         => $this->name,
          'descriptions' => $this->descriptions,
          'date'         => $this->date,
          'teacher'      => [
            'id'   => $this->teacher->id,
            'name' => $this->teacher->name,
            'image'=> $this->teacher->image
          ]
        ];
    }
}
