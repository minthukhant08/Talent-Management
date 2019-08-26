<?php

namespace App\Http\ApiControllers;

use App\User;
use App\Http\ApiControllers\APIBaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface as UserInterface;
use App\Http\Resources\User as UserResource;
use Validator;
use Hash;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $userInterface;

    public function __construct(Request $request, UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
        $this->method        = $request->getMethod();
        $this->endpoint      = $request->path();
        $this->startTime     = microtime(true);
    }

    public function convertUserType($value, $default)
    {
        if (strcasecmp($value, 'normal') == 0) {
            return 0;
        }elseif (strcasecmp($value, 'student') == 0){
            return 1;
        }elseif (strcasecmp($value, 'teacher') == 0){
            return 2;
        }elseif (strcasecmp($value, 'scanner') == 0) {
           return 3;
        }else{
          return $default;
        }
    }

    public function convertGender($value, $default)
    {
        if (strcasecmp($value, 'male') == 0) {
            return 0;
        }elseif (strcasecmp($value, 'female') == 0) {
            return 1;
        }else {
            return $default;
        };
    }

    public function index(Request $request)
    {
        $this->offset = isset($request->offset)? $request->offset : 0;
        $this->limit  = isset($request->limit)? $request->limit : 30;
        $name         = isset($request->name)? $request->name : '%';
        $course       = isset($request->course)? $request->course : '%';
        $batch        = isset($request->batch)? $request->batch : '%';
        $gender       = isset($request->gender)? $request->gender : '%';
        $type         = isset($request->type)? $request->type : '%';

        $type = $this->convertUserType($type, '%');
        $gender    = $this->convertGender($gender, '%');

        $users = UserResource::collection($this->userInterface->getAll($this->offset, $this->limit, $type, $name, $course, $batch, $gender));
        $total = $this->userInterface->total();
        $this->data($users);
        $this->total($total);
        return $this->response('200');
    }

    public function giveResults(Request $request)
    {
        $this->offset = isset($request->offset)? $request->offset : 0;
        $this->limit  = isset($request->limit)? $request->limit : 30;
        $course_id       = isset($request->course_id)? $request->course_id : '%';
        $batch_id        = isset($request->batch_id)? $request->batch_id : '%';

        $users = $this->userInterface->giveResults($this->offset, $this->limit, $course_id, $batch_id);
        $total = $this->userInterface->total();
        $this->data($users);
        $this->total($total);
        return $this->response('200');
    }

    public function login(Request $request)
    {

        // dd($request->only('email', 'password'));
        $email = $request->email;
        $password = $request->password;
        $user = $this->userInterface->findByEmail($request->email);
        if (empty($user)) {
            $this->setError('401');
            return $this->response('401');
        }else{
            // $credentials = $request->only('email', 'password');
            $credentials = array('email'=>$email, 'password'=>$password);
            if (!$token = JWTAuth::attempt($credentials)) {
                $this->setError('401');
                return $this->response('401');
            }else{
              $user = new UserResource($user);
              $this->data(array('user' => $user, 'token' => $token));
              return $this->response('201');
            }
        }
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
              'name'        =>  'required',
              'email'       =>  'required',
              'image'       =>  'required',
              'uid'         =>  'required',
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

         $user = $request->all();
         $existing_user = User::where('email', '=',  $user['email'])->first();
         $result;
         if (empty($existing_user)) {
             $user['type'] = 0;
             $user['image'] = $user['image'];
             $result = $this->userInterface->store($user);

             if (isset($result)) {
                // $token = JWTAuth::fromUser($result);
                $result = new UserResource($result);
                $this->data(array('user' => $result, 'auth_token' => $result->auth_token));
                return $this->response('201');
             }else{
                return $this->response('500');
             }
         }else{
             $token = JWTAuth::fromUser($existing_user);
             $existing_user = new UserResource($existing_user);
             $this->data(array('user' => $existing_user, 'auth_token' => $existing_user->auth_token));
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
        $user = $this->userInterface->find($id);
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

        $user = $this->userInterface->find($id);
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
            if ($this->userInterface->update($user,$id)) {
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
        $user = $this->userInterface->find($id);
        if (empty($user)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->userInterface->destroy($id);
            $this->data(array('deleted' =>  1));
            return $this->response('200');
        }
    }
}
