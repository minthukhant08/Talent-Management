<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use App\Http\ApiControllers\APIBaseController as BaseController;
use App\Repositories\TopicDetail\TopicDetailRepositoryInterface as TopicDetailInterface;
use App\Http\Resources\TopicDetail as TopicDetailResource;
use App\Events\ContentCRUDEvent;
use Validator;

class TopicDetailController extends BaseController
{
    public $topicdetailInterface;

    public function __construct(Request $request, TopicDetailInterface $topicdetailInterface)
    {
        $this->topicdetailInterface = $topicdetailInterface;
        $this->method               = $request->getMethod();
        $this->endpoint             = $request->path();
        $this->startTime            = microtime(true);
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
        $topicdetail  = TopicDetailResource::collection($this->topicdetailInterface->getAll($this->offset, $this->limit));
        $total = $this->topicdetailInterfacteacher_e->total();
        $this->data($topicdetail);
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
                        'topic_id'     =>  'required|exists:topic,id',
                        'name'         =>  'required',
                        'descriptions' =>  'required',
                        'date'         =>  'required|date',
                        'teacher_id'   =>  'required|exists:user,id',
                        'admin_id'     =>  'required'
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

         $topicdetail = $request->all();
         $result = $this->topicdetailInterface->store($topicdetail);

         if (isset($result)) {
           $this->data(array('id' =>  $result));
           event(new ContentCRUDEvent('Create Topic Detail', $request->admin_id, 'Create', 'Created '. $result->name. ' Topic Detail.'));
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
        $topicdetail = $this->topicdetailInterface->find($id);
        if (empty($topicdetail)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $topicdetail = new TopicDetailResource($topicdetail);
            $this->data(array($topicdetail));
            return $this->response('201');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTimeTable($teacher_id)
    {
        $topicdetail = $this->topicdetailInterface->getTimeTable($teacher_id);
        if (empty($teacher_id)) {
            $this->setError('404', $teacher_id);
            return $this->response('404');
        }else{
            $topicdetail = TopicDetailResource::collection($topicdetail);
            $this->data(array($topicdetail));
            return $this->response('201');
        }
    }

    public function getByTopicId($topic_id)
    {
        $topicdetail = $this->topicdetailInterface->getByTopicId($topic_id);
        if (empty($topic_id)) {
            $this->setError('404', $topic_id);
            return $this->response('404');
        }else{
            $topicdetail = TopicDetailResource::collection($topicdetail);
            $this->data($topicdetail);
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
                        'date'         =>  'date',
                        'teacher_id'   =>  'exists:user,id',
                        'topic_id'     =>  'exists:topic,id',
                        'admin_id'     =>  'required'
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
        $topicdetail = $this->topicdetailInterface->find($id);
        if (empty($topicdetail)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            if ($this->topicdetailInterface->update($request->all(),$id)) {
                $this->data(array('updated' =>  1));
                event(new ContentCRUDEvent('Update Topic Detail', $request->admin_id, 'Update', 'Updated '. $topicdetail->name. ' Topic Detail.'));
                return $this->response('200');
            }else {
                return $this->response('500');
            };
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
        $topicdetail = $this->topicdetailInterface->find($id);
        if (empty($topicdetail)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
          $this->topicdetailInterface->destroy($id);
          $this->data(array('deleted' =>  1));
          return $this->response('200');
        }
    }
}
