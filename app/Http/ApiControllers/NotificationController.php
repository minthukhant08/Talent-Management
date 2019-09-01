<?php

namespace App\Http\ApiControllers;

use App\Notification;
use App\Http\ApiControllers\APIBaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\Notification\NotificationRepositoryInterface as NotificationInterface;
use App\Http\Resources\Notification as NotificationResource;
use Validator;

class NotificationController extends BaseController
{

    public function convertNotificationType($value, $default)
    {
        if (strcasecmp($value, 'info') == 0) {
            return 0;
        }elseif (strcasecmp($value, 'offer') == 0){
            return 1;
        }elseif (strcasecmp($value, 'comfirm') == 0){
            return 2;
        }else{
          return $default;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $notificationInterface;

    public function __construct(Request $request, NotificationInterface $notificationInterface)
    {
        $this->notificationInterface = $notificationInterface;
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
              'type'         =>  'required',
              'title'        =>  'required',
              'descriptions' =>  'required',
              'date'         =>  'required|date',
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

         $notification = $request->all();
         $notification['type'] = $this->convertNotificationType($notification['type'], 0);
         $result = $this->notificationInterface->store($notification);

         if (isset($result)) {
           $this->data(array('id' =>  $result->id));
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
        $this->limit  = isset($request->limit)? $request->limit : 10;
        $notification = $this->notificationInterface->getByUserID($id, $this->limit);
        if (empty($notification)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $notification = NotificationResource::collection($notification);
            $this->data($notification);
            $this->total($this->notificationInterface->getUnseen($id));
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
        $notification = $this->notificationInterface->find($id);
        if (empty($notification)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->notificationInterface->destroy($id);
            $this->data(array('deleted' =>  1));
            return $this->response('200');
        }
    }

    public function seen($id)
    {
       $this->notificationInterface->seeAll($id);
       return $this->response('201');
    }
}
