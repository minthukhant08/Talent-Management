<?php

namespace App\Repositories\User;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Repositories\User\UserRepositoryInterface as UserInterface;

class UserRepository implements UserInterface
{
  public $user;

  public function __construct(User $user)
  {
     $this->user = $user;
  }

  public function getAll($offset, $limit, $type, $name, $course, $batch, $gender){
    return $this->user::with('course','batch')->orderBy('created_at', 'desc')
        ->whereHas('course', function($query) use ($course) {
          $query->where('name', 'like', '%'.$course.'%');
          })
        ->whereHas('batch', function($query) use ($batch) {
          $query->where('name', 'like', '%'.$batch.'%');
          })
        ->where([
          ['type','like', '%'.$type.'%'],
          ['name','like', '%'.$name.'%'],
          ['gender','like', '%'.$gender.'%']
        ])
        ->skip($offset)
        ->take($limit)
        ->get();
  }

  public function giveResults($offset, $limit,$assignment_id){
    return  DB::table('user')
            ->join('student_assignment', 'user.id', '=', 'student_assignment.student_id')
            ->join('assignment', 'student_assignment.assignment_id', '=', 'assignment.id')
            ->select('user.*','student_assignment.marks')
	          ->where('assignment.id','=',$assignment_id)
            ->skip($offset)
            ->take($limit)
            ->get();
  }

  public function find($id)
  {
    return $this->user::with('course','batch')->where('id', '=', $id)->first();
  }

  public function findByEmail($email)
  {
    return $this->user::with('course','batch')->where('email', '=', $email)->first();
  }

  public function destroy($id)
  {
    return $this->user::find($id)->delete();
  }

  public function total()
  {
    return $this->user::count();
  }

  public function store($data){
      $this->user->fill($data);
      if ($this->user->save()) {
        return $this->user;
      }
  }

  public function delete($id)
  {
    $this->user = $this->user->find($id);
    $this->user->softdelete();
  }

  public function update($request, $id)
  {
    $this->user = $this->user->find($id);
    $this->user->fill($request);
    if ($this->user->save()) {
        return true;
    };
  }
}
