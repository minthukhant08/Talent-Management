<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\ApiControllers\APIBaseController as BaseController;
use Validator;
use App\Admin;

class ReportsController extends BaseController
{

    public function __construct(Request $request)
    {
        $this->method            = $request->getMethod();
        $this->endpoint          = $request->path();
        $this->startTime         = microtime(true);
    }

    public function numberOfUserPerMonth(Request $request)
    {
        $first_year = DB::select("SELECT  MONTH(created_at) month,  count(*)count FROM user
                      WHERE YEAR(created_at) = ". $request->first_year ."
                      GROUP BY MONTH(created_at)
                      ");

       $label=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
       $data=[];
       $isset = false;
       for ($i=1; $i <= 12 ; $i++) {
         foreach ($first_year as $year) {
           if ($year->month==$i) {
               array_push($data, $year->month);
               $isset = true;
               break;
           }
         }
         if ($isset==false) {
             array_push($data, 0);
         }
         $isset = false;
       }

       $second_year = DB::select("SELECT  MONTH(created_at) month,  count(*)count FROM user
                     WHERE YEAR(created_at) = ". $request->second_year ."
                     GROUP BY MONTH(created_at)
                     ");
       $data2 = [];
       for ($i=1; $i <= 12 ; $i++) {
         foreach ($second_year as $year) {
           if ($year->month==$i) {
               array_push($data2, $year->month);
               $isset = true;
               break;
           }
         }
         if ($isset==false) {
             array_push($data2, 0);
         }
         $isset = false;
       }
       // dd($data);
       $object  = (object) ["label" => $request->first_year, "backgroundColor" => $this->randomColor(),  "data" => $data];
       $object2 = (object) ["label" => $request->second_year, "backgroundColor" => $this->randomColor(),  "data" => $data2];
       $result = array(
         "labels" => $label,
         "datasets" => array($object, $object2)
       );

       $this->data($result);
       return $this->response('200');

    }

    public function numberOfAdmin()
    {
      $admins =DB::table('admin')
                     ->select(DB::raw('count(*) as count, role'))
                     ->groupBy('role')
                     ->get();

     $normal_users =DB::table('user')
                    ->select(DB::raw('count(*) as count, type'))
                    ->groupBy('type')
                    ->get();

      $users=[];
      $types=[];
      foreach ($admins as $admin) {
          array_push($users, $admin->count);
          if ($admin->role == 0) {
              array_push($types, "Super Admin");
          }else{
            array_push($types, "Admin");
          }

      }
      foreach ($normal_users as $user) {
        if ($user->type !=4) {
            array_push($users, $user->count);
            if ($user->type == 0) {
                array_push($types, "Normal");
            }else if ($user->type == 1) {
                array_push($types, "Student");
            }else if ($user->type == 2){
              array_push($types, "Teacher");
            }else if ($user->type == 3){
              array_push($types, "Scanner");
            }
        }

      }

      $object = (object) ["label" => $types, "backgroundColor" => [$this->randomColor(),$this->randomColor(), $this->randomColor(), $this->randomColor(), $this->randomColor(), $this->randomColor()],  "data" => $users];
      $data = array(
        "labels" => $types,
        "datasets" => [
            $object
          ]
      );
      $this->data($data);
      return $this->response('200');
    }

    public function teachersintrack()
    {
      $teachers = DB::select("SELECT COUNT(*) count, course.name batch FROM user
                    LEFT JOIN course on course.id = user.course_id
                    WHERE user.type = 2
                    GROUP BY course.name");
      $label=[];
      $teacher_count=[];
      foreach ($teachers as $teacher) {
        array_push($label, $teacher->batch);
        array_push($teacher_count, $teacher->count);
      }
      $object = (object) ["label" => $label, "backgroundColor" => [$this->randomColor(),$this->randomColor(), $this->randomColor(), $this->randomColor(), $this->randomColor(), $this->randomColor()],  "data" => $teacher_count];
      $data = array(
        "labels" => $label,
        "datasets" => [
            $object
          ]
      );
      $this->data($data);
      return $this->response('200');
    }

    public function studentsintrack()
    {
      $teachers = DB::select("SELECT COUNT(*) count, course.name batch FROM user
                    LEFT JOIN course on course.id = user.course_id
                    WHERE user.type = 1
                    GROUP BY course.name");
      $label=[];
      $teacher_count=[];
      foreach ($teachers as $teacher) {
        array_push($label, $teacher->batch);
        array_push($teacher_count, $teacher->count);
      }
      $object = (object) ["label" => $label, "backgroundColor" => [$this->randomColor(), $this->randomColor(), $this->randomColor(), $this->randomColor(), $this->randomColor(), $this->randomColor()],  "data" => $teacher_count];
      $data = array(
        "labels" => $label,
        "datasets" => [
            $object
          ]
      );
      $this->data($data);
      return $this->response('200');
    }

    public function usersinbatch()
    {
      $results = DB::select("SELECT COUNT(*) count, batch.name batchname, user.type FROM user
                  LEFT JOIN batch on batch.id = user.batch_id
                  WHERE user.type = 1 or user.type = 2
                  GROUP BY batch.name, user.id");
      $batches = DB::select("SELECT DISTINCT batch.name from batch");
      $batch_label=[];
      $user_lable=[];
      foreach ($batches as $batch) {
        array_push($batch_label, $batch->name);
      }
      $dataset=[];
      foreach ($batch_label as $batch) {
        $obj_data=[];
        foreach ($results as $result) {
          if ($result->batchname == $batch) {
            array_push($obj_data, $result->count);
          }
        }
        $object = (object) ["label" => $batch, "backgroundColor" => $this->randomColor(),  "data" => $obj_data];
        array_push($dataset, $object);
        $obj_data=[];
      }
      // $object = (object) ["label" => $batch_label, "backgroundColor" => ['red', 'blue', 'green', 'yellow', 'pink', 'white'],  "data" => $teacher_count];
      $data = array(
        "labels" => ['Students', 'Teachers'],
        "datasets" => $dataset
      );
      $this->data($data);
      return $this->response('200');
    }
    public function randomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
