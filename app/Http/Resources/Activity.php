<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Like;

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
        $liked=0;
        $like_id= null;
        if ($this->type == 0) {
           $this->type = "post";
        }elseif ($this->type == 1){
           $this->type = "announcement";
        }
        // foreach ($this->likes as $like) {
        //     if ($like->user_id == $request->user_id) {
        //        $liked=1;
        //     }
        // }
        $like = Like::where([['user_id','=', $request->user_id],['activity_id', '=', $this->id]])->first();
        if (empty($like)) {
            $liked = 0;

        }else{
           $liked = 1;
           $like_id = $like->id;
        }

        return [
          'id'            => $this->id,
          'name'          => $this->name,
          'date'          => $this->date,
          'speaker'       => $this->speaker_name,
          'type'          => $this->type,
          'descriptions'  => $this->descriptions,
          'image'         => url('/api/v1/activities/image').'/'.$this->id,
          'comments'      => $this->comments->count(),
          'like'          => [
                'id'      => $like_id,
                'likes'   => $this->likes->count(),
                'liked'   => $liked
          ]
        ];
    }
}
