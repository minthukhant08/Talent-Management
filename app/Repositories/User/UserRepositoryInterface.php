<?php
namespace App\Repositories\User;

interface UserRepositoryInterface{
  public function getAll($offset, $limit, $type, $name, $course, $batch, $gender);
  public function giveResults($offset, $limit, $assignment_id);
  public function find($id);
  public function findByEmail($email);
  public function total();
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
