<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use App\Http\ApiControllers\APIBaseController as BaseController;
use App\Repositories\Result\ResultRepositoryInterface as ResultInterface;

use Validator;


class ResultController extends BaseController
{
    public $resultInterface;

    public function __construct(Request $request, ResultInterface $resultInterface)
    {
        $this->resultInterface = $resultInterface;
        $this->method          = $request->getMethod();
        $this->endpoint        = $request->path();
        $this->startTime       = microtime(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->offset = isset($request->offset)? $request->offset : 0;
        $this->limit  = isset($request->limit)? $request->limit : 30;
        $student_id;
        if(isset($request->student_id)){
          $student_id = $request->student_id;
        }else{
          $this->setError('404');
          return $this->response('404');
        }
        $result =$this->resultInterface->getAll($this->offset, $this->limit, $student_id);
        $total = $this->resultInterface->total();
        $this->data($result);
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
                'student_id' => 'required|exists:user,id',
                'assignment_id'=>'required|exists:assignment,id',
                'marks'      =>  'required',

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

         $result = $request->all();

         $result = $this->resultInterface->store($result);

         if (isset($result)) {
             $this->data(array('id' =>  $result));
         }

         return $this->response('201');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->resultInterface->find($id);
        if (empty($result)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
        //   $result = new CourseResource($result);
          $this->data(array($result));
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'student_id'     =>   'exists:user,id',
                'assignment_id'    => 'exists:assignment,id'
            ]);

        if ($validator->fails()) {
            $this->setError('400');
            $messages=[];

            foreach ($validator->messages()->toArray() as $key=>$value) {
                  $messages[] = (object)['attribue' => $key, 'message' => $value[0]];
            };

            $this->setValidationError(['validation' => $messages]);
            return $this->response('400');
        }
        $result = $this->resultInterface->find($id);
        if (empty($result)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
          if ($this->resultInterface->update($request->all(),$id)) {
              $this->data(array('updated' =>  1));
              return $this->response('200');
          }else{
              return $this->response('500');
          }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->resultInterface->find($id);
        if (empty($result)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
          $this->resultInterface->destroy($id);
          $this->data(array('deleted' =>  1));
          return $this->response('200');
        }
    }

    /**
     * show image of the Course resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
