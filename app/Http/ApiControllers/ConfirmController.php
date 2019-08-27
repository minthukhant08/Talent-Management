<?php

namespace App\Http\ApiControllers;

use App\Http\ApiControllers\APIBaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Confirm\ConfirmRepositoryInterface as ConfirmInterface;
use App\Repositories\User\UserRepositoryInterface as UserInterface;
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
         $confirm = $this->confirmInterface->find($confirm['user_id'], $confirm['code']);
         // dd($confirm);
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
                 return $this->response('201');
             }
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
        $user = $this->confirmInterface->find($id);
        if (empty($user)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $user = new UserResource($user);
            $this->data(array($user));
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
              'email'     =>  'email',
              'date_of_birth'=> 'date',
              'image'     =>  'image'
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

        $user = $this->confirmInterface->find($id);
        if (empty($user)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $user = $request->all();
            try {
              $user['type'] = $this->convertUserType($user['type'], 0);
            } catch (\Exception $e) {

            }
            try {
              $user['gender'] = $this->convertGender( $user['gender'], 0);
            } catch (\Exception $e) {

            }
            if ($this->confirmInterface->update($user,$id)) {
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
        $user = $this->confirmInterface->find($id);
        if (empty($user)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->confirmInterface->destroy($id);
            $this->data(array('deleted' =>  1));
            return $this->response('200');
        }
    }
}
