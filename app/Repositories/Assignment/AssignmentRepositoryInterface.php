<?php
namespace App\Repositories\Assignment;

interface AssignmentRepositoryInterface {
  public function getAll($offset, $limit,$teacher_id);
  public function total();
  public function store($data);
  public function delete($id);
  public function destroy($id);
  public function find($id);




}
