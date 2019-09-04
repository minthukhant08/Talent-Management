<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use App\Http\ApiControllers\APIBaseController as BaseController;
use App\Repositories\Log\LogRepositoryInterface as LogInterface;
use App\Http\Resources\Log as LogResource;
use App\log;
use Validator;

class LogController extends BaseController
{

    public $logInterface;

    public function __construct(Request $request, LogInterface $logInterface)
    {
        $this->logInterface = $logInterface;
        $this->method            = $request->getMethod();
        $this->endpoint          = $request->path();
        $this->startTime         = microtime(true);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $this->offset = isset($request->offset)? $request->offset : 0;
         $this->limit  = isset($request->limit)? $request->limit : 100;
         $admin_id = isset($request->admin_id)? $request->admin_id : 0;

         $log = LogResource::collection($this->logInterface->getAll($this->offset, $this->limit, $admin_id));
         $total = $this->logInterface->total();
         $this->data($log);
         $this->total($total);
         return $this->response('200');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = $this->logInterface->find($id);
        if (empty($log)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $this->logInterface->destroy($id);
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
    public function image($id)
    {
        $img = $this->logInterface->find($id)->image;
        return response(base64_decode($img), 200, ['Content-Type' => 'image/png',]);
    }
}
