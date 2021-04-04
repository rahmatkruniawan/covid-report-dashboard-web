<?php

namespace App\Services\Inform;

use Illuminate\Http\Request;
use App\Services\Inform\InformPayloadPreventor;
use App\Services\Inform\Builder\InformBuilder;
use App\Services\Inform\Builder\ResponseBuilder;
use App\Services\Inform\Builder\ImageBuilder;
use Validator;

class InformHandler
{
    private $payload_preventor;
    private $error_payload;
    private $inform_builder;
    private $response_builder;
    private $request;
    private $image_builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->response_builder = new ResponseBuilder();
        $this->image_builder = new ImageBuilder($this->request);
        $this->inform_builder = new InformBuilder($this->request);
        $this->payload_preventor = new InformPayloadPreventor($this->request);
    }

    public function saveReport()
    {
        if ($this->hasErrorFromPayloadPreventor()) {
            return $this->response_builder->error($this->error_payload);
        }

        $this->saveInformation();

        $this->saveImage();

        return $this->response_builder->successfullySaveData();
    }

    private function hasErrorFromPayloadPreventor()
    {
        $this->error_payload = $this->payload_preventor->prevent();
        if (is_null($this->error_payload)) {
            return false;
        }

        return true;
    }

    private function saveInformation()
    {
        $this->inform_builder->build();
    }

    private function saveImage()
    {
        $this->request['lapor_id'] = $this->inform_builder->inform_model->id;
        $this->image_builder->build();
    }
}