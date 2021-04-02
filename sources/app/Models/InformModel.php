<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformModel extends Model
{
    protected $table = 'lapor';

    public function setReporterName(?string $reporterName)
    {
        $this->nama_pelapor = $reporterName;
    }

    public function setReporterPhoneNumber(?string $reporterPhoneNumber)
    {
        $this->no_hp_pelapor = $reporterPhoneNumber;
    }

    public function setReporterEmail(?string $reporterEmail)
    {
        $this->email_pelapor = $reporterEmail;
    }

    public function setReportedName(?string $reportedName)
    {
        $this->nama_terlapor = $reportedName;
    }

    public function setReportedPhoneNumber(?string $reportedPhoneNumber)
    {
        $this->no_hp_terlapor = $reportedPhoneNumber;
    }

    public function setReportDescription(?string $reportDescription)
    {
        $this->deskripsi_laporan = $reportDescription
    }

    public function setLatitude(?string $latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude(?string $longitude)
    {
        $this->longitude = $longitude;
    }

    public function setAddress(?string $address)
    {
        $this->alamat = $address;
    }

    public function setDistricts(?string $district)
    {
        $this->kecamatan = $district;
    }

    public function setRegency(?string $regency)
    {
        $this->regency = $regency;
    }

    public function setProvince(?string $province)
    {
        $this->provinsi = $province;
    }

    public function setStatus(?string $status)
    {
        $this->status = $status;
    }
}
