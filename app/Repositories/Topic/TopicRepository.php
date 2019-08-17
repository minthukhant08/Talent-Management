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
        return $this->topic->id;
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
