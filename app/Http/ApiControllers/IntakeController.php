<?php

namespace App\Http\ApiControllers;

use Illuminate\Http\Request;
use App\Http\ApiControllers\APIBaseController as BaseController;
use App\Repositories\Intake\IntakeRepositoryInterface as IntakeInterface;
use App\Http\ApiControllers\IntakeAvailableEvent;
use App\Http\Resources\Intake as IntakeResource;
use Validator;

class IntakeController extends BaseController
{

    public $intakeInterface;

    public function __construct(Request $request, IntakeInterface $intakeInterface)
    {
        $this->intakeInterface = $intakeInterface;
        $this->method            = $request->getMethod();
        $this->endpoint          = $request->path();
        $this->startTime         = microtime(true);
    }


    public function get()
    {
        $intake = $this->intakeInterface->getIntake();
        if (empty($intake)) {
            $this->setError('404', $id);
            return $this->response('404');
        }else{
            $intake = new IntakeResource($intake);
            $this->data(array($intake));
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
              'available'          =>  'required',
              'form_link'         =>  'required'
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
        $intake = $this->intakeInterface->getIntake();
        $newintake = $this->intakeInterface->update($request->all());
        if (!empty($newintake)) {
            if ($newintake->available != $intake->available ) {
                event(new IntakeAvailableEvent($newintake));
            }
            $this->data(array('updated' =>  1));
            return $this->response('200');
        }else{
            return $this->response('200');
        }
    }
}
