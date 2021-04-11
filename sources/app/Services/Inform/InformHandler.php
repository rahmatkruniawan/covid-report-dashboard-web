<?php

namespace App\Services\Inform;

use Illuminate\Http\Request;
use App\Models\ReportHistory;
use App\Services\Inform\InformPayloadPreventor;
use App\Services\Inform\Builder\InformBuilder;
use App\Services\Inform\Builder\ResponseBuilder;
use App\Services\Inform\Builder\ImageBuilder;
use App\Models\InformModel;
use Validator;

class InformHandler
{
    private $payload_preventor;
    private $error_payload;
    private $inform_builder;
    private $response_builder;
    private $request;
    private $image_builder;
    private $report_history;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->response_builder = new ResponseBuilder();
        $this->image_builder = new ImageBuilder($this->request);
        $this->inform_builder = new InformBuilder($this->request);
        $this->payload_preventor = new InformPayloadPreventor($this->request);
        $this->report_history = new ReportHistory();
        $this->inform_model = new InformModel($request);
    }

    public function saveReport()
    {
        if ($this->hasErrorFromPayloadPreventor()) {
            return $this->response_builder->error($this->error_payload);
        }

        try {
            $this->saveInformation();
            $this->saveImage();
            $this->saveReportHistory();

            return $this->response_builder->successfullySaveData();
        } catch (Exception $e) {
            $e->getMessage();
        }
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

    private function saveReportHistory()
    {
        $this->report_history->setReportId($this->inform_builder->inform_model->id);
        $this->report_history->setStatus($this->inform_builder->default_status);
        $this->report_history->setUserId(null);
        $this->report_history->save();
    }

    public function searchReport($request)
    {
        $this->search = $request->input('cari');

        $reports = $this->getReportDataByReporterPhoneNumberOrReportCode();

        if (count($reports) == 0) {
            return $this->response_builder->error($error = 'data_not_found');
        }

        $searchResults = [];
        foreach ($reports as $report) {
            $searchResults[] = $report;
        }

        return $this->response_builder->successfullyLoadData($searchResults);
    }

    private function getReportDataByReporterPhoneNumberOrReportCode()
    {
        return $this->inform_model->loadReportLists()
            ->where('no_hp_pelapor', '=', $this->search)
            ->orWhere('kode_lapor', '=', $this->search)
            ->get();
    }
}