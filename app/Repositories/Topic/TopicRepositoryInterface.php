<?php
namespace App\Repositories\Topic;

interface TopicRepositoryInterface{
  public function find($id);
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
