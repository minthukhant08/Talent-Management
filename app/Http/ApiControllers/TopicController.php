<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use App\Http\ApiControllers\APIBaseController as BaseController;
use App\Repositories\Topic\TopicRepositoryInterface as TopicInterface;
use App\Http\Resources\Topic as TopicResource;
use Validator;

class TopicController extends BaseController
{
    public $topicInterface;

    public function __construct(Request $request, TopicInterface $topicInterface)
    {
        $this->topicInterface = $topicInterface;
        $this->method           = $request->getMethod();
        $this->endpoint         = $request->path();
        $this->startTime        = microtime(true);
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
                        'course_id'   =>  'required|exists:course,id',
                        'topic'       =>  'required',
                        'descriptions'=>  'required'
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

         $topic = $request->all();
         $result = $this->topicInterface->store($topic);

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
        $topic = $this->topicInterface->find($id);
        if (empty($topic)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $topic = new TopicResource($topic);
            $this->data(array($topic));
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
                        'course_id'  =>  'exists:course,id'
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
        $topic = $this->topicInterface->find($id);
        if (empty($topic)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            if ($this->topicInterface->update($request->all(),$id)) {
                $this->data(array('updated' =>  1));
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
        $topic = $this->topicInterface->find($id);
        if (empty($topic)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
          $this->topicInterface->destroy($id);
          $this->data(array('deleted' =>  1));
          return $this->response('200');
        }
    }
}
