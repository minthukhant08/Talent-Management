<?php

namespace App\Http\ApiControllers;

use App\NotificationToken;
use App\Http\ApiControllers\APIBaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\NotificationToken\NotificationTokenRepositoryInterface as NotificationTokenInterface;
use App\Http\Resources\NotificationToken as NotificationTokenResource;
use Validator;

class NotificationTokenController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $notificationTokenInterface;

    public function __construct(Request $request, NotificationTokenInterface $notificationTokenInterface)
    {
        $this->notificationTokenInterface = $notificationTokenInterface;
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'token'        =>  'required',
              'subscribe'    =>  'required',
              'user_id'      =>  'required|exists:user,id'
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
         $notificationtoken = $request->all();
         // dd($this->notificationTokenInterface->exist($request->id, $request->token));
         if ($this->notificationTokenInterface->exist($request->user_id, $request->token)) {
             $result = $this->notificationTokenInterface->update($notificationtoken);
             if (isset($result)) {
               $this->data(array('id' =>  $result->id));
             }
         }else{
             $result = $this->notificationTokenInterface->store($notificationtoken);
             if (isset($result)) {
               $this->data(array('id' =>  $result->id));
             }
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
        $notificationtoken = $this->notificationTokenInterface->getByUserID($id);
        if (empty($notificationtoken)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $notificationtoken = NotificationTokenResource::collection($notificationtoken);
            $this->data($notificationtoken);
            $this->total($this->notificationTokenInterface->total());
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
        $notificationtoken = $this->notificationTokenInterface->find($id);
        if (empty($notificationtoken)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->notificationTokenInterface->destroy($id);
            $this->data(array('deleted' =>  1));
            return $this->response('200');
        }
    }
}
