<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\ReportHistory;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return view('history.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  \Yajra\DataTables\DataTables  $dt
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $req, DataTables $dt)
    {
        $columns = [
            'riwayat_lapor.created_at as tanggal',
            'lapor.kode_lapor',
            'kategori_laporan.nama as nama_kategori_laporan',
            'riwayat_lapor.status',
            'riwayat_lapor.catatan',
            'users.name as oleh',
            // Hidden column
            'lapor.id'
        ];

        $data = ReportHistory::select($columns)
        ->join('users', 'users.id','=','riwayat_lapor.user_id')
        ->join('lapor', 'lapor.id','=','riwayat_lapor.lapor_id')
        ->join('kategori_laporan', 'kategori_laporan.id','=','lapor.kategori_laporan_id');

        return $dt->eloquent($data)
                ->addIndexColumn()
                ->filterColumn('tanggal', function($query, $keyword) {
                    $sql = "LOWER(`riwayat_lapor`.`created_at`) LIKE ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn('oleh', function($query, $keyword) {
                    $sql = "LOWER(`users`.`name`) LIKE ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn('nama_kategori_laporan', function($query, $keyword) {
                    $sql = "LOWER(`kategori_laporan`.`nama`) LIKE ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addcolumn('action', function($row) use ($req) {
                    return '<a data-toggle="tooltip" title="Detail" href="'.route('report.detail',['id'=>$row->id]).'"><i class="bx bx-task"></i></a>';
                })
                ->toJson();
    }

}
