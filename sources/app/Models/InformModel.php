<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class InformModel extends Model
{
    protected $table = 'lapor';
    private $request = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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

    public function setReportCategory($reportCategory)
    {
        $this->kategori_laporan_id = $reportCategory;
    }

    public function setReportDescription(?string $reportDescription)
    {
        $this->deskripsi_laporan = $reportDescription;
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
        $this->kabupaten = $regency;
    }

    public function setProvince(?string $province)
    {
        $this->provinsi = $province;
    }

    public function setStatus(?string $status)
    {
        $this->status = $status;
    }

    public function getReporterName()
    {
        return $this->request['nama_pelapor'];
    }

    public function getReporterPhoneNumber()
    {
        return $this->request['no_hp_pelapor'];
    }

    public function getReporterEmail()
    {
        return $this->request['email_pelapor'];
    }

    public function getReportedName()
    {
        return $this->request['nama_terlapor'];
    }

    public function getReportedPhoneNumber()
    {
        return $this->request['no_hp_terlapor'];
    }

    public function getReportCategory()
    {
        return $this->request['kategori_laporan_id'];
    }

    public function getReportDescription()
    {
        return $this->request['deskripsi_laporan'];
    }

    public function getLatitude()
    {
        return $this->request['latitude'];
    }

    public function getLongitude()
    {
        return $this->request['longitude'];
    }

    public function getAddress()
    {
        return $this->request['alamat'];
    }

    public function getDistricts()
    {
        return $this->request['kecamatan'];
    }

    public function getRegency()
    {
        return $this->request['kabupaten'];
    }

    public function getProvince()
    {
        return $this->request['provinsi'];
    }

    public function getStatus()
    {
        return $this->request['status'];
    }
}
