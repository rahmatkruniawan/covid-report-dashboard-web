<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    protected $table = 'riwayat_lapor';

    public function loadReportHistoryByReported($reportId)
    {
    	return $this::where('lapor_id', '=', $reportId)
    		->latest()
    		->first();
    }

    public function setReportId($reportId)
    {
    	$this->lapor_id = $reportId;
    }

    public function setStatus($status)
    {
    	$this->status = $status;
    }

    public function setUserId($userId)
    {
    	$this->user_id = $userId;
    }
}
