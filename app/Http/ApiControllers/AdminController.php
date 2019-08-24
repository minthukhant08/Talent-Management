<?php

namespace App\Http\ApiControllers;

use App\Admin;
use App\Http\ApiControllers\APIBaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Admin\AdminRepositoryInterface as AdminInterface;
use App\Http\Resources\Admin as AdminResource;
use Validator;
use Hash;
use JWTAuth;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $adminInterface;

    public function __construct(Request $request, AdminInterface $adminInterface)
    {
        $this->adminInterface = $adminInterface;
        $this->method        = $request->getMethod();
        $this->endpoint      = $request->path();
        $this->startTime     = microtime(true);
    }

    public function convertRoleType($value, $default)
    {
        if (strcasecmp($value, 'superadmin') == 0) {
            return 0;
        }elseif (strcasecmp($value, 'admin') == 0){
            return 1;
        }else{
          return $default;
        }
    }


    public function index(Request $request)
    {
        $admin = AdminResource::collection($this->adminInterface->getAll());
        $total = $this->adminInterface->total();
        $this->data($admin);
        $this->total($total);
        return $this->response('200');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'name'      =>  'required',
              'email'     =>  'required|email',
              'image'     =>  'required',
              'auth_token'=>  'required'
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

         $admin = $request->all();
         if ($this->adminInterface->total() <= 0) {
             $admin['role'] = 0;
         }
         $existing_admin = $this->adminInterface->findByEmail($admin['email']);
         if (empty($existing_admin)) {
             $result = $this->adminInterface->store($admin);
             if (isset($result)) {
                $result = new AdminResource($result);
                $this->data(array('user' => $result, 'auth_token' => $result->auth_token));
                return $this->response('201');
             }else{
                return $this->response('500');
             }
         }else{
             // $token = JWTAuth::fromUser($existing_user);
             $existing_admin = new AdminResource($existing_admin);
             $this->data(array('user' => $existing_admin, 'auth_token' => $existing_admin->auth_token));
             return $this->response('201');
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
        $admin = $this->adminInterface->find($id);
        if (empty($admin)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $admin = new AdminResource($admin);
            $this->data(array($admin));
            return $this->response('201');
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
        $admin = $this->adminInterface->find($id);
        if (empty($admin)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->adminInterface->destroy($id);
            $this->data(array('deleted' =>  1));
            return $this->response('200');
        }
    }
}
