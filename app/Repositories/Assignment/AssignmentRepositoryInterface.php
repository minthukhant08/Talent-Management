<?php
namespace App\Repositories\Assignment;

interface AssignmentRepositoryInterface {
  public function getAll($offset, $limit);
  public function total();
  public function store($data);
  public function delete($id);
  public function destroy($id);


}
