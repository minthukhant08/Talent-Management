<?php

namespace App\Repositories\Like;

use App\Like;
use App\Repositories\Like\LikeRepositoryInterface as LikeInterface;

class LikeRepository implements LikeInterface
{
  public $like;

  public function __construct(Like $like)
  {
     $this->like = $like;
  }

  public function getAll($offset, $limit){
    return $this->like::orderBy('created_at', 'desc')
        ->skip($offset)
        ->take($limit)
        ->get();
  }

  public function find($id)
  {
    return $this->like::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->like::find($id)->delete();
  }

  public function total()
  {
    return $this->like::count();
  }

  public function isliked($activity_id, $user_id)
  {
      $like = $this->like::where([['activity_id','=', $activity_id],['user_id','=', $user_id]])->first();
      $count = $this->like::where('activity_id', '=', $activity_id)->count();
      if (isset($like)) {
          return array('id'=>$like->id, 'liked'=> true, 'count' => $count);
      }else{
          return array('id'=> null, 'liked'=> false, 'count' => $count);
      }
  }

  public function store($data){
      $this->like->fill($data);
      if ($this->like->save()) {
        return $this->like->id;
      }
  }

  public function delete($id)
  {
    $this->like = $this->like->find($id);
    $this->like->softdelete();
  }

  public function update($request, $id)
  {
    $this->like = $this->like->find($id);
    $this->like->fill($request);
    $this->like->save;
  }
}
