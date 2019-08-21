<?php

namespace App\Repositories\TopicDetail;

use App\TopicDetail;
use App\Repositories\TopicDetail\TopicDetailRepositoryInterface as TopicDetailInterface;

class TopicDetailRepository implements TopicDetailInterface
{
  public $topicdetail;

  public function __construct(TopicDetail $topicdetail)
  {
     $this->topicdetail = $topicdetail;
  }


  public function find($id)
  {
    return $this->topicdetail::where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->topicdetail::find($id)->delete();
  }

  public function store($data){
      $this->topicdetail->fill($data);
      if ($this->topicdetail->save()) {
        return $this->topicdetail->id;
      }
  }

  public function delete($id)
  {
    $this->topicdetail = $this->topicdetail->find($id);
    $this->topicdetail->softdelete();
  }

  public function update($request, $id)
  {
    $this->topicdetail = $this->topicdetail->find($id);
    $this->topicdetail->fill($request);
    if ($this->topicdetail->save()) {
        return true;
    };
  }
}
