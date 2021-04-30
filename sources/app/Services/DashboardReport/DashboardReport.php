<?php

namespace App\Services\DashboardReport;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Mail\SendMail;
use App\Models\InformModel;
use Yajra\DataTables\DataTables;
use App\Models\ReportHistory;

class DashboardReport
{
    private $inform_model;
    private $request;
    private $data_tables;
    private $report_history_model;
    private $detail_report;

    public function __construct()
    {
        $this->inform_model = new InformModel($request = null);
        $this->report_history_model = new ReportHistory();
    }

    public function showAll()
    {
        return view('reports.list');
    }

    public function getReportData($request, $dataTables)
    {
        $this->data_tables = $dataTables;
        return $this->fetchReportLists($request);
    }

    public function fetchReportLists($request)
    {
        return $this->data_tables->of($this->getReportLists())
            ->addcolumn('action', function($row) use ($request) {
                return
                    '<a data-toggle="tooltip" title="Edit" href="'.route('report.detail',['id'=>$row->id]).'"><i class="bx bx-edit"></i></a>';
            })
            ->toJson();
    }

    public function getReportLists()
    {
        return $this->inform_model->loadReportLists();
    }

    public function getDetailReport($id)
    {
        $report = $this->inform_model
            ->loadReportLists()
            ->where('lapor.id', '=', $id)
            ->first();

        if ($report->image != null) {
            $image = asset($report->image);
        } else {
            $image = null;
        }

        $reportStatus = [
            'menunggu',
            'diproses',
            'dibatalkan',
            'selesai'
        ];

        $histories = $this->getReportHistory($id);

        return view('reports.detail', [
            'report' => $report,
            'reportStatus' => $reportStatus,
            'image' => $image,
            'histories' => $histories
        ]);
    }

    public function setStatusReport($request, ?int $reportId)
    {
        try {
            $this->request = $request;
            $this->user = Auth::user();
            $this->status = $this->request->input('status');
            $this->setStatusReportHistory($reportId);
            $this->updateStatusReported($reportId);
            $this->sendEmail();

            $response = ($reportId) ? trans('message.update.success') : trans('message.create.success');
        } catch (\Exception $e) {
            $e->getMessage();

            $response = ($reportId) ? trans('message.update.failed') : trans('message.create.failed');
        }

        if($this->request->ajax()){
            return response()->json($response);
        }else{
            $this->request->session()->flash('status',$response);
            return redirect()->route('report');
        }
    }

    public function getReportHistoryByReported($reportId)
    {
        return (new ReportHistory())->loadReportHistoryByReported($reportId);
    }

    public function updateStatusReported($reportId)
    {
        $this->report = $this->inform_model->findOrFail($reportId);

        $this->report->status = $this->status;
        $this->report->save();
    }

    public function setStatusReportHistory($reportId)
    {
        $this->report_history_model->setReportId($reportId);
        $this->report_history_model->setStatus($this->status);
        $this->report_history_model->setUserId($this->user->id);
        $this->report_history_model->setMessage($this->request->input('catatan'));
        $this->report_history_model->save();
    }

    public function getReportHistory($reportId)
    {
        return (new ReportHistory())->loadReportHistory($reportId);
    }

    private function sendEmail()
    {
        $view = 'emails.progress';
        $content = $this->buildProgressContent();
        \Mail::to($this->report->email_pelapor)->send(new SendMail($this->report->nama_pelapor, $view, $content));
    }

    private function buildProgressContent()
    {
        if (! empty($this->request->input('catatan'))) {
            $notes = "Berikut catatan dari tim Satgas Covid: {$this->request->input('catatan')}";
        } else {
            $notes = '';
        }

        $status = strtoupper($this->status);

        $content = $status . ' ' . $notes;
        return $content;
    }
}
