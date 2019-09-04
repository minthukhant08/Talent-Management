<?php
namespace App\Repositories\Topic;

interface TopicRepositoryInterface{
  public function getAll($offset, $limit);
  public function getByCourseId($course_id);
  public function getList($course_id);
  public function find($id);
  public function total();
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
