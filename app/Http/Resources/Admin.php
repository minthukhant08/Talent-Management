<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Admin extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type='Admin';
        if ($this->role == 0) {
           $type = "Super Admin";
        }else{
           $type = "Admin";
        }

        return [
          'id'            =>  $this->id,
          'name'          =>  $this->name,
          'email'         =>  $this->email,
          'image'         =>  $this->image,
          'uid'           =>  $this->uid,
          'role'          =>  $type
        ];
    }
}
