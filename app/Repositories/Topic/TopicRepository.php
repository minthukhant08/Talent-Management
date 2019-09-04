<?php

namespace App\Repositories\Topic;

use App\Topic;
use App\Repositories\Topic\TopicRepositoryInterface as TopicInterface;

class TopicRepository implements TopicInterface
{
  public $topic;

  public function __construct(Topic $topic)
  {
     $this->topic = $topic;
  }

  public function getAll($offset, $limit){
    return $this->topic::with('details')->orderBy('created_at', 'desc')
        ->skip($offset)
        ->take($limit)
        ->get();
  }

  public function getByCourseId($course_id)
  {
    return $this->topic::where('course_id', '=', $course_id)->get();
  }

  public function getList($course_id){
    return $this->topic::distinct()->where('course_id', '=', $course_id)->get(['topic','id']);
  }

  public function total()
  {
    return $this->topic::count();
  }

  public function find($id)
  {
    return $this->topic::with('details')->where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->topic::find($id)->delete();
  }

  public function store($data){
      $this->topic->fill($data);
      if ($this->topic->save()) {
        return $this->topic;
      }
  }

  public function delete($id)
  {
    $this->topic = $this->topic->find($id);
    $this->topic->softdelete();
  }

  public function update($request, $id)
  {
    $this->topic = $this->topic->find($id);
    $this->topic->fill($request);
    if ($this->topic->save()) {
        return true;
    };
  }
}
