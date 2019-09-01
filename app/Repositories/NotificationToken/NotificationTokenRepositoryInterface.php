<?php
namespace App\Repositories\NotificationToken;

interface NotificationTokenRepositoryInterface{
  public function find($id);
  public function getByUserID($id);
  public function exist($id, $token);
  public function total();
  public function store($data);
  public function update($data);
  public function destroy($id);
}
