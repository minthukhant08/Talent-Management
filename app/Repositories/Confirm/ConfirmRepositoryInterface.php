<?php
namespace App\Repositories\Confirm;

interface ConfirmRepositoryInterface{
  public function find($id);
  public function getByUserID($id);
  public function total();
  public function getAll($offset, $limit, $name);
  public function store($data);
  public function destroy($id);
}
