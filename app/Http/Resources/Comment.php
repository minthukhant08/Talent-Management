<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
        $type ='';

        if ($this->type == 0) {
           $type = "normal";
        }elseif ($this->type == 1){
           $type = "student";
        }elseif ($this->type == 2){
           $type = "teacher";
        }elseif ($this->type == 3) {
           $type = "scanner";
        }

        return [
          'id'             => $this->id,
          'descriptions'   => $this->descriptions,
          'activity_id'    => $this->activity_id,
          'user'           => [ 'id'    => $this->user->id,
                                'name'  => $this->user->name,
                                'image' => $this->user->image,
                                'type'  => $type

          ]
        ];
    }
}
