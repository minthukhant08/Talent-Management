<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
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
          $this->type = 'Info';
        }elseif ($this->type == 1) {
          $this->type = 'Offer';
        }elseif ($this->type == 2){
          $this->type = 'Confirmation';
        };

        return [
          'title'         => $this->title,
          'type'          => $this->type,
          'descriptions'  => $this->descriptions,
          'date'          => $this->date
        ];
    }
}
