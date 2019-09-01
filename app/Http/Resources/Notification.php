<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DateTime;

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
        $code='';
        if ($this->type == 0) {
          $this->type = 'Info';
        }elseif ($this->type == 1) {
          $this->type = 'Offer';
        }elseif ($this->type == 2){
          $this->type = 'Confirmation';
        };

        if ($this->confirmation == null) {
            $code = null;
        }else{
            $code = $this->confirmation->code;
        }

        return [
          'title'         => $this->title,
          'type'          => $this->type,
          'descriptions'  => $this->descriptions,
          'date'          => date_format(new DateTime($this->date),"d F, Y"),
          'seen'          => $this->seen,
          'code'          => $code
        ];
    }
}
