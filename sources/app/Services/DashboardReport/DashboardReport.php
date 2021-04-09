<?php

namespace App\Services\DashboardReport;

use Illuminate\Http\Request;
use App\Models\InformModel;
use Yajra\DataTables\DataTables;

class DashboardReport
{
    private $inform_model;

    public function __construct()
    {
        $this->inform_model = new InformModel($request = null);
    }

    public function showAll()
    {
        return view('reports.list');
    }

    public function getReportData($req, $dataTables)
    {
        return $this->fetchReportLists($req, $dataTables);
    }

    public function fetchReportLists($req, $dataTables)
    {
        return $dataTables->eloquent($this->inform_model->orderBy('id', 'desc'))
            ->addcolumn('action', function($row) use ($req) {
                return  '<a data-toggle="tooltip" title="Edit" href="'.route('user.edit',['id'=>$row->id]).'"><i class="bx bx-edit"></i></a>'.
                        '<a data-toggle="tooltip" title="Delete" href="#" onclick="deleteRow(\'delete-form-'.$row->id.'\', userTable)"><i class="bx bx-trash"></i></a>'.
                        '<form id="delete-form-'.$row->id.'" action="'.route('user.delete',['id'=>$row->id]).'" method="POST" style="display: none;"><input name=_token value='.csrf_token().' type=hidden></form>';
            })
            ->toJson();
    }
}
