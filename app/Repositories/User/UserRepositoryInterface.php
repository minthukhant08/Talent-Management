<?php
namespace App\Repositories\User;

interface UserRepositoryInterface{
  public function getAll($offset, $limit, $type, $name, $course, $batch, $gender, $admin);
  public function giveResults($offset, $limit, $assignment_id);
  public function find($id);
  public function findByUid($uid);
  public function total();
  public function store($data);
  public function update($request, $id);
  public function delete($id);
  public function timeTable($teacher_id);
}
