<?php
namespace App\Repositories\Result;

interface ResultRepositoryInterface{
  public function getAll($offset, $limit, $student_id);
  public function find($id);
  public function total();
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
