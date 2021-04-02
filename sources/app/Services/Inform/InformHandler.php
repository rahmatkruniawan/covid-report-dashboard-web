<?php

namespace App\Services\Inform;

use Illuminate\Http\Request;
use App\Services\Inform\InformPayloadPreventor;
use App\Services\Inform\Builder\InformBuilder;
use App\Services\Inform\Builder\ResponseBuilder;

class InformHandler
{
    private $payload_preventor;
    private $error_payload;
    private $inform_builder;
    private $response_builder;

    public function __construct(Request $request)
    {
        $this->payload_preventor = new InformPayloadPreventor($request);
        $this->inform_builder = new InformBuilder($request);
        $this->response_builder = new ResponseBuilder();
    }

    public function saveReport()
    {
        if ($this->hasErrorFromPayloadPreventor()) {
            return $this->response_builder->error($this->error_payload);
        }

        $this->inform_builder->build();
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
}