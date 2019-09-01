<?php

namespace App\Http\ApiControllers;

use App\Http\ApiControllers\APIBaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Confirm\ConfirmRepositoryInterface as ConfirmInterface;
use App\Repositories\User\UserRepositoryInterface as UserInterface;
use App\Http\Resources\Confirm as ConfirmResource;
use App\Events\ContentCRUDEvent;
use Validator;
use Hash;

class ConfirmController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $confirmInterface;
    public $userInterface;

    public function __construct(Request $request, ConfirmInterface $confirmInterface, UserInterface $userInterface)
    {
        $this->confirmInterface = $confirmInterface;
        $this->userInterface    = $userInterface;
        $this->method        = $request->getMethod();
        $this->endpoint      = $request->path();
        $this->startTime     = microtime(true);
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
         $name         = isset($request->name)? $request->name : '%';

         $confirm = ConfirmResource::collection($this->confirmInterface->getAll($this->offset, $this->limit, $name));
         $total = $this->confirmInterface->total();
         $this->data($confirm);
         $this->total($total);
         return $this->response('200');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scan(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'scanner_id' =>  'required|exists:user,id',
              'code'       =>  'required',
              'user_id'    =>  'required|exists:user,id'
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
         $confirm = $request->all();
         $confirm = $this->confirmInterface->confirm($confirm['user_id'], $confirm['code']);
         if (empty($confirm)) {
             $this->setError('501', $request->code);
             $this->setValidationError(['message' => "Wrong Code"]);
             return $this->response('501');
         }else{
             $this->confirmInterface->destroy($confirm->id);
             $user = [
               'type' => 1
             ];
             if ($this->userInterface->update($user, $confirm->user_id)) {
                 event(new ContentCRUDEvent('Confirmed Student', 1, 'Confirm', 'Confirmed '. $confirm->user->name. ' as student.'));
                 return $this->response('201');
             }
         }
    }


}
