<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TopicDetail as TopicDetailResource;

class Topic extends JsonResource
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
          'id'          => $this->id,
          'topic'       => $this->topic,
          'descriptions'=> $this->descriptions,
          'start_date'  => $this->start_date,
          'end_date'    => $this->end_date,
          'detail'      => TopicDetail::collection($this->details)
        ];
    }
}
