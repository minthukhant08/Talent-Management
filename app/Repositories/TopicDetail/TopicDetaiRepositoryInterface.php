<?php
namespace App\Repositories\TopicDetail;

interface TopicDetailRepositoryInterface{
  public function getAll($offset, $limit);
  public function find($id);
  public function total();
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
