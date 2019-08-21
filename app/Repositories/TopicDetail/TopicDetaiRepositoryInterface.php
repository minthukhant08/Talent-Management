<?php
namespace App\Repositories\TopicDetail;

interface TopicDetailRepositoryInterface{
  public function find($id);
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
