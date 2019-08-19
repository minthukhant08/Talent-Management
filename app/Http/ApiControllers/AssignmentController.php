<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use App\Http\ApiControllers\APIBaseController as BaseController;
use App\Repositories\Assignment\AssignmentRepositoryInterface as AssignmentInterface;
use App\Http\Resources\Assignment as AssignmentResource;
use Validator;

class AssignmentController extends BaseController
{

    public $assignmentInterface;

    public function __construct(Request $request, AssignmentInterface $assignmentInterface)
    {
        $this->assignmentInterface = $assignmentInterface;
        $this->method            = $request->getMethod();
        $this->endpoint          = $request->path();
        $this->startTime         = microtime(true);
    }

    // private function convertPostType($value, $default)
    // {
    //     if (strcasecmp($value, 'post') == 0) {
    //         return 0;
    //     }elseif (strcasecmp($value, 'announcement') == 0){
    //         return 1;
    //     }else{
    //       return $default;
    //     }
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $this->offset = isset($request->offset)? $request->offset : 0;
         $this->limit  = isset($request->limit)? $request->limit : 30;
         $name         = isset($request->name)? $request->name : '%';


         $assignment=AssignmentResource::collection($this->assignmentInterface->getAll($this->offset, $this->limit, $name));
         $total = $this->assignmentInterface->total();
         $this->data($assignment);
         $this->total($total);
         return $this->response('200');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'name'          =>  'required',
              'teacher_id'       =>  'required',

          ]);

        if ($validator->fails()) {
            $this->setError('400');
            $messages=[];

            foreach ($validator->messages()->toArray() as $key=>$value) {
                  $messages[] = (object)['attribue' => $key, 'message' => $value[0]];
            }

            $this->setValidationError(['validation' => $messages]);
            return $this->response('400');
        }

       $assignment = $request->all();
       $result = $this->assignmentInterface->store($assignment);

       if (isset($result)) {
          $this->data(array('id' =>  $result));
          return $this->response('201');
       }else{
          return $this->response('500');
       }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = $this->assignmentInterface->find($id);
        if (empty($assignment)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $assignment = new AssignmentResource($assignment);
            $this->data(array($assignment));
            return $this->response('201');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignment = $this->assignmentInterface->find($id);
        if (empty($assignment)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->assignmentInterface->destroy($id);
            $this->data(array('deleted' =>  1));
            return $this->response('200');
        }
    }

    /**
     * show image of the Activity resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
