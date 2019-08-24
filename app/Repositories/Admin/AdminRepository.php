<?php

namespace App\Repositories\Admin;

use App\Admin;
use App\Repositories\Admin\AdminRepositoryInterface as AdminInterface;

class AdminRepository implements AdminInterface
{
  public $admin;

  public function __construct(Admin $admin)
  {
     $this->admin = $admin;
  }

  public function getAll(){
    return $this->admin::orderBy('created_at', 'desc')->get();
  }

  public function find($id)
  {
    return $this->admin::where('id', '=', $id)->first();
  }

  public function findByEmail($email)
  {
    return $this->admin::where('email', '=', $email)->first();
  }

  public function destroy($id)
  {
    return $this->admin::find($id)->delete();
  }

  public function total()
  {
    return $this->admin::count();
  }

  public function store($data){
      $this->admin->fill($data);
      if ($this->admin->save()) {
        return $this->admin;
      }
  }

  public function delete($id)
  {
    $this->admin = $this->admin->find($id);
    $this->admin->softdelete();
  }

  public function update($request, $id)
  {
    $this->admin = $this->admin->find($id);
    $this->admin->fill($request);
    if ($this->admin->save()) {
        return true;
    };
  }
}
