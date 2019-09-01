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

  public function getAll($offset, $limit,$teacher_id){
    return $this->assignment::with('teacher')->orderBy('created_at', 'desc')
        ->where('teacher_id', '=' , $teacher_id)
        ->skip($offset)
        ->take($limit)
        ->get();
  }
  public function find($id)
  {
      return $this->assignment::with('teacher')->where('id', '=', $id)->first();
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
