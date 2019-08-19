<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $course = null;
       $batch = null;

       if ($this->type == 0) {
          $this->type = "normal";
       }elseif ($this->type == 1){
          $this->type = "student";
       }elseif ($this->type == 2){
          $this->type = "teacher";
       }elseif ($this->type == 3) {
          $this->type = "scanner";
       }

       if ($this->gender == 0) {
           $this->gender = "male";
       }else{
           $this->gender = "female";
       }

       if ($this->course_id != null) {
           $course = ['id' => $this->course->id, 'name' => $this->course->name];
       }

       if ($this->batch_id  != null) {
           $batch  = ['id' => $this->batch->id, 'name' => $this->batch->name];
       }
    //    return parent::toArray(  $request);
       return [
         'id'            =>  $this->id,
         'name'          =>  $this->name,
         'email'         =>  $this->email,
         'gender'        =>  $this->gender,
         'date_of_birth' =>  $this->date_of_birth,
         'nrc_no'        =>  $this->nrc_no,
         'phone_no'      =>  $this->phone_no,
         'address'       =>  $this->address,
         'image'         =>  $this->image,
         'type'          =>  $this->type,
         'course'        =>  $course,
         'batch'         =>  $batch
       ];
    }
}
