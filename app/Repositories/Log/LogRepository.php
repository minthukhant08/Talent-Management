<?php

namespace App\Repositories\Log;

use App\Log;
use App\Repositories\Log\LogRepositoryInterface as LogInterface;

class LogRepository implements LogInterface
{
  public $log;

  public function __construct(Log $log)
  {
     $this->log = $log;
  }

  public function getAll($offset, $limit, $admin_id){
    if ($admin_id > 0 ) {
      return $this->log::with('admins')->orderBy('created_at', 'desc')
          ->where([
            ['admin_id','=', $admin_id]
          ])
          ->skip($offset)
          ->take($limit)
          ->get();
    }else{
      return $this->log::with('admins')->orderBy('created_at', 'desc')
          ->skip($offset)
          ->take($limit)
          ->get();
    }

  }


  public function destroy($id)
  {
    return $this->log::find($id)->delete();
  }

  public function total()
  {
    return $this->log::count();
  }

  public function store($data){
      $this->log->fill($data);
      if ($this->log->save()) {
        return $this->log->id;
      }
  }

  public function delete($id)
  {
    $this->log = $this->log->find($id);
    $this->log->softdelete();
  }

  public function update($request, $id)
  {
    $this->log = $this->log->find($id);
    $this->log->fill($request);
    if ($this->log->save()) {
        return true;
    }
  }
}
