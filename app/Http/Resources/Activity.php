<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Activity extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->type == 0) {
           $this->type = "post";
        }elseif ($this->type == 1){
           $this->type = "announcement";
        }

        return [
          'id'            => $this->id,
          'name'          => $this->name,
          'date'          => $this->date,
          'speaker'       => $this->speaker_name,
          'type'          => $this->type,
          'descriptions'  => $this->descriptions,
          'image'         => url('/api/v1/activities/image').'/'.$this->id,
          'likes'         => $this->likes->count(),
          'comments'      => $this->comments->count()
        ];
    }
}
