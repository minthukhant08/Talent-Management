<?php

namespace App\Repositories\Assignment;

use App\Assignment;
use App\Repositories\Assignment\AssignmentRepositoryInterface as AssignmentInterface;

class AssignmentRepository implements AssignmentInterface
{
  public $assignment;

  public function __construct(Assignment $assignment)
  {
     $this->assignment = $assignment;
  }

  public function getAll($offset, $limit){
    return $this->assignment::with('teacher')->orderBy('created_at', 'desc')
        ->skip($offset)
        ->take($limit)
        ->get();
  }


  public function destroy($id)
  {
    return $this->assignment::find($id)->delete();
  }

  public function total()
  {
    return $this->assignment::count();
  }

  public function store($data){
      $this->assignment->fill($data);
      if ($this->assignment->save()) {
        return $this->assignment;
      }
  }

  public function delete($id)
  {
    $this->assignment = $this->assignment->find($id);
    $this->assignment->softdelete();
  }

}
