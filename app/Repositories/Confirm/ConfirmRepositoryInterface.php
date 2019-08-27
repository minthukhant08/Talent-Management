<?php
namespace App\Repositories\Confirm;

interface ConfirmRepositoryInterface{
  public function find($id);
  public function getByUserID($id);
  public function store($data);
  public function destroy($id);
}
