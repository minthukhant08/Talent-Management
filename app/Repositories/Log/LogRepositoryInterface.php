<?php
namespace App\Repositories\Log;

interface LogRepositoryInterface{
  public function getAll($offset, $limit, $admin_id);
  public function total();
  public function store($data);
  public function update($request, $id);
  public function delete($id);
}
