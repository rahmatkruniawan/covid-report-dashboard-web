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
    private $last_report;

    public $inform_model;

    public function __construct(Request $request)
    {
        $this->inform_model = new InformModel($request);
        $this->last_report = $this->inform_model->loadLastReport();
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

    /**
     * Note:
     * Format report code is: {report_category}{last_3_digits_phone_number_reported}{current_date}
     * (2021/4/5) Yasser Yazid M
     */
    private function createReportCode()
    {
        if ($this->last_report != null) {
            $id = $this->last_report->id + 1;
        } else {
            $id = 1;
        }

        $lastThreeDidgitsPhoneNumberReporter = substr($this->inform_model->getReporterPhoneNumber(), -3);
        $currentDate = Carbon::now()->format('ymd');
        $reportCode = $this->inform_model->getReportCategory() .
            $lastThreeDidgitsPhoneNumberReporter .
            $currentDate .
            $id;

        return $reportCode;
    }
}