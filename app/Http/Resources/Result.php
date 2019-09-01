<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Result extends JsonResource
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
        return [
          "id"            => $this->id,
          "marks"         => $this->marks,
          "comments"      => $this->comments,
          "assignment"    => [
            "id"          => $this->assignment->id,
            "name"        => $this->assignment->name
          ]
        ];
    }
}
