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
        // return parent::toArray($request);
        $user=User::find($this->teacher_id)->select('name', 'id', 'image')->first();
        return [
          'id'           => $this->id,
          'name'         => $this->name,
          'descriptions' => $this->descriptions,
          'date'         => $this->date,
          'teacher'      => $user
        ];
    }
}
