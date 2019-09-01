<?php
namespace App\Repositories\Course;

interface CourseRepositoryInterface{
  public function getAll($offset, $limit);
  public function getList();
  public function find($id);
  public function total();
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
