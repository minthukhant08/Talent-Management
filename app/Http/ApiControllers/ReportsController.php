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

    public function numberOfUserPerMonth()
    {
        $users =DB::table('user')
                       ->select(DB::raw("COUNT(*) count, MONTH(created_at) month"))
                       ->groupBy(DB::raw( "MONTH(created_at)"))
                       ->get();

       $label=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
       $data=[];
       $isset = false;
       for ($i=1; $i <= 12 ; $i++) {
         foreach ($users as $user) {
           if ($user->month==$i) {
               array_push($data, $user->month);
               $isset = true;
               break;
           }
         }
         if ($isset==false) {
             array_push($data, 0);
         }
         $isset = false;
       }
       $object = (object) ["label" => $label, "backgroundColor" => 'red',  "data" => $data];
       $result = array(
         "labels" => $label,
         "datasets" => [
             $object
           ]
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

      $count=[];
      foreach ($admins as $admin) {
          array_push($count, $admin->count);
      }
      $object = (object) ["label" => ['Admin', 'Super Admin'], "backgroundColor" => ['red', 'blue'],  "data" => $count];
      $data = array(
        "labels" => ['Admin', 'Super Admin'],
        "datasets" => [
            $object
          ]
      );
      $this->data($data);
      return $this->response('200');
    }

}
