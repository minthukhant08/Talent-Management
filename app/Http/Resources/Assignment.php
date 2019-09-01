<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Assignment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $user=User::find($this->teacher_id)->select('name', 'id', 'image')->first();

        // return parent::toArray($request);


        return [
          'id'            => $this->id,
          'name'          => $this->name,
          'date'          => $this->created_at,
          'teacher'       => [ 'id' => $this->teacher->id,
                            'name'  => $this->teacher->name,
                            'image' => url('/api/v1/users/image').'/'.$this->id,

          ]
        ];
    }
}
