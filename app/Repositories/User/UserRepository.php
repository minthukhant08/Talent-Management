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
  public function getNormalUsers(){
    return $this->user::where('type','=',0)->get();
  }
  public function getAll($offset, $limit, $type, $name, $course, $batch, $gender, $admin){
    if ($admin) {
      return $this->user::with('course','batch')->orderBy('created_at', 'desc')
          ->where([
            ['type','like', '%'.$type.'%'],
            ['name','like', '%'.$name.'%']
          ])
          ->skip($offset)
          ->take($limit)
          ->get();
    }else{
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
  }

  public function giveResults($offset, $limit,$assignment_id){
    return  DB::table('user')
            ->join('student_assignment', 'user.id', '=', 'student_assignment.student_id')
            ->join('assignment', 'student_assignment.assignment_id', '=', 'assignment.id')
            ->select('user.*','student_assignment.*')
	          ->where('assignment.id','=',$assignment_id)
            ->skip($offset)
            ->take($limit)
            ->get();
  }

  public function find($id)
  {
    return $this->user::with('course','batch')->where('id', '=', $id)->first();
  }

  public function findByUid($uid)
  {
    return $this->user::with('course','batch')->where('uid', '=', $uid)->first();
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
  public function timeTable($teacher_id)
  {
    return DB::table('course')
            ->join('topic', 'topic.course_id', '=', 'course.id')
            ->join('topic_detail', 'topic.id', '=', 'topic_detail.topic_id')
            ->join('user','user.id','=','topic_detail.teacher_id')
            ->select('course.name AS course_name','topic.topic', 'topic.start_date',
            'topic.end_date','topic_detail.name AS topic_detail_name',
            'topic_detail.date','topic_detail.descriptions','user.id')
            ->where('user.id','=', $teacher_id)
            ->get();
  }
}
