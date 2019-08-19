<?php

namespace App\Repositories\Result;

use App\StudentAssignement;
use App\Repositories\Result\ResultRepositoryInterface as ResultInterface;

class ResultRepository implements ResultInterface
{
  public $result;

  public function __construct(StudentAssignement $result)
  {
     $this->result = $result;
  }

  public function getAll($offset, $limit, $student_id)
  {
          return $this->result::with('assignment')->orderBy('created_at', 'desc')
                                ->where('student_id', '=', $student_id)
                                ->skip($offset)
                                ->take($limit)
                                ->get();


  }

  public function find($id)
  {
    return $this->result::with('user')->where('id', '=', $id)->first();
  }

  public function destroy($id)
  {
    return $this->result::find($id)->delete();
  }

  public function total()
  {
    return $this->result::count();
  }

  public function store($data){
      $this->result->fill($data);
      if ($this->result->save()) {
        return $this->result->id;
      }
  }

  public function delete($id)
  {
    $this->result = $this->result->find($id);
    $this->result->softdelete();
  }

  public function update($request, $id)
  {
    $this->result = $this->result->find($id);
    $this->result->fill($request);
    if ($this->result->save()) {
        return true;
    }
  }
}
