<?php

namespace App\Repositories\Assignment;

use App\Assignment;
use App\User;
use App\StudentAssignement;
use App\Repositories\Assignment\AssignmentRepositoryInterface as AssignmentInterface;

class AssignmentRepository implements AssignmentInterface
{
  public $assignment;
  public $user;
  public $studentAssignment;

  public function __construct(Assignment $assignment,User $user, StudentAssignement $studentAssignment)
  {
     $this->assignment = $assignment;
     $this->user        = $user;
     $this->studentAssignment = $studentAssignment;
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
          $teacher_id = $this->assignment->teacher_id;
          $teacher = $this->user::find($teacher_id);
          $students = $this->user::where([['batch_id', '=', $teacher->batch_id], ['course_id', '=', $teacher->course_id], ['type', '=', 1]])->orderBy('created_at', 'desc')->get();
          foreach ($students as $student) {
            $this->studentAssignment->fill([
              'student_id'    => $student->id,
              'assignment_id' => $this->assignment->id,
              'marks'         => 0,
              'comments'      => "",

            ]);
            $this->studentAssignment->save();
          }
          return true;
      }
  }

  public function delete($id)
  {
    $this->assignment = $this->assignment->find($id);
    $this->assignment->softdelete();
  }

}
