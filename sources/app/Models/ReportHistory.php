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

    public function setReportId(?int $reportId)
    {
    	$this->lapor_id = $reportId;
    }

    public function setStatus(?string $status)
    {
    	$this->status = $status;
    }

    public function setUserId(?int $userId)
    {
    	$this->user_id = $userId;
    }
}
