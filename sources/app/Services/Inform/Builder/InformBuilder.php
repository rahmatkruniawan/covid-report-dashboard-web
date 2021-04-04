<?php

namespace App\Services\Inform\Builder;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\InformModel;

class InformBuilder implements InformInterface
{
    private $request;
    private $default_status = 'menunggu';
    private $default_province = 'Daerah Istimewa Yogyakarta';

    public $inform_model;

    public function __construct(Request $request)
    {
        $this->inform_model = new InformModel($request);
    }

    public function build()
    {
        $this->create();
        $this->inform_model->save();
    }

    public function create()
    {
        $this->inform_model->setReportCode($this->createReportCode());
        $this->inform_model->setReportCategory($this->inform_model->getReportCategory());
        $this->inform_model->setReporterName($this->inform_model->getReporterName());
        $this->inform_model->setReporterPhoneNumber($this->inform_model->getReporterPhoneNumber());
        $this->inform_model->setReporterEmail($this->inform_model->getReporterEmail());
        $this->inform_model->setReportedName($this->inform_model->getReportedName());
        $this->inform_model->setReportedPhoneNumber($this->inform_model->getReportedPhoneNumber());
        $this->inform_model->setReportDescription($this->inform_model->getReportDescription());
        $this->inform_model->setLatitude($this->inform_model->getLatitude());
        $this->inform_model->setLongitude($this->inform_model->getLongitude());
        $this->inform_model->setAddress($this->inform_model->getAddress());
        $this->inform_model->setDistricts($this->inform_model->getDistricts());
        $this->inform_model->setRegency($this->inform_model->getRegency());
        $this->inform_model->setProvince($this->default_province);
        $this->inform_model->setStatus($this->default_status);
    }

    private function createReportCode()
    {
        $currentDate = Carbon::now()->format('ymdHis');
        $reportCode = $this->inform_model->getReportCategory() . $currentDate;

        return $reportCode;
    }
}