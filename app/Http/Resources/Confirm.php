<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Confirm extends JsonResource
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
          'user_id' => $this->user->id,
          'code'    => $this->code,
          'image'   => $this->user->image
        ];
    }
}
