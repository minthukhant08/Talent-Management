<?php

namespace App\Http\ApiControllers;

use App\Admin;
use App\Http\ApiControllers\APIBaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Admin\AdminRepositoryInterface as AdminInterface;
use App\Repositories\User\UserRepositoryInterface as UserInterface;
use App\Http\Resources\Admin as AdminResource;
use App\Events\ContentCRUDEvent;
use Validator;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $adminInterface;
    public $userInterface;

    public function __construct(Request $request, AdminInterface $adminInterface, UserInterface $userInterface)
    {
        $this->adminInterface = $adminInterface;
        $this->userInterface = $userInterface;
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
        $type  = isset($request->type)? $request->type : 'admin';
        $type  = $this->convertRoleType($type,1);
        $admin = AdminResource::collection($this->adminInterface->getAll($type));
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
            'uid'   =>  'required',
            'email' =>  'email',
            'image' =>  'required'
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
           $result = $this->adminInterface->store($admin);
           event(new ContentCRUDEvent('Login', $result->id, 'Initial', 'root admin login'));
           if (isset($result)) {
              $result = new AdminResource($result);
              $this->data(array('user' => $result));
              return $this->response('201');
           }else{
              return $this->response('401');
           }
       }else{
          $existing_admin = $this->adminInterface->findByUid($admin['uid']);
          if (!empty($existing_admin)) {
             $existing_admin = new AdminResource($existing_admin);
             $this->data(array('user' => $existing_admin));
             return $this->response('201');
          }else{
              return $this->response('401');
          }

       }
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'user_id'   =>  'required|exists:user,id',
            'role'      =>  'required',
            'admin_id'  =>  'required|exists:admin,id'
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

       $user = $this->userInterface->find($request->user_id);
       $admin = [
         'id'   => $user->id,
         'name' => $user->name,
         'image'=> $user->image,
         'email'=> $user->email,
         'uid'  => $user->uid,
         'role' => $request->role
       ];
       $result = $this->adminInterface->store($admin);
       if (isset($result)){
          event(new ContentCRUDEvent('Create Admin', $request->admin_id, 'Promote', 'Gave admin privileges to '. $result->name));
          $result = new AdminResource($result);
          $this->data(array('user' => $result));
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
    public function destroy(Request $request, $id)
    {
      // dd($request->all());
      $validator = Validator::make($request->all(), [
            'admin_id'  =>  'required|exists:admin,id'
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
        $admin = $this->adminInterface->find($id);
        if (empty($admin)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->adminInterface->destroy($id);
            event(new ContentCRUDEvent('Remove Admin', $request->admin_id, 'Demote', 'Remove admin privileges from '. $admin->name));
            $this->data(array('deleted' =>  1));
            return $this->response('200');
        }
    }
}
