<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\DashboardReport\DashboardReport;

class ReportController extends Controller
{
	private $dashboard_report;

	public function __construct()
	{
		$this->dashboard_report = new DashboardReport();
	}

    public function index()
    {
    	return $this->dashboard_report->showAll();
    }

    public function setReportData(Request $req, DataTables $dataTables) {
    	return $this->dashboard_report->getReportData($req, $dataTables);
    }

    public function detailReport($id)
    {
        return $this->dashboard_report->getDetailReport($id);
    }

    public function setStatusReport(Request $request, $id)
    {
        return $this->dashboard_report->setStatusReport($request, $id);
    }
}
