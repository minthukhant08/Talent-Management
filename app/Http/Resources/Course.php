<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseTopic as CourseTopicResource;

class Course extends JsonResource
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
          'id'              => $this->id,
          'name'            => $this->name,
          'descriptions'    => $this->descriptions,
          'start_date'      => $this->start_date,
          'end_date'        => $this->end_date,
          'image'           => url('/api/v1/courses/image').'/'.$this->id,
          'topic'         => CourseTopicResource::collection($this->details)
        ];
    }
}
