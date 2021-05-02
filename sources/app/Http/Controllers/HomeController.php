<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;

use App\User;
use App\Models\Lapor;
use App\Models\ReportCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
        $total_user = User::count('id');
        $total_laporan = Lapor::count('id');
        $total_laporan_pasien = Lapor::where('kategori_laporan_id',1)->count('id');
        $total_laporan_prokes = Lapor::where('kategori_laporan_id',2)->count('id');
        $statistik_status_laporan = Lapor::select('status',\DB::raw('count(id) as jumlah'))
                                            ->groupBy('status')
                                            ->get()
                                            ->toArray();
        $statistik_wilayah_laporan = Lapor::select('kabupaten',
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 1 THEN 1 ELSE NULL END) AS bulan_1'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 2 THEN 1 ELSE NULL END) AS bulan_2'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 3 THEN 1 ELSE NULL END) AS bulan_3'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 4 THEN 1 ELSE NULL END) AS bulan_4'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 5 THEN 1 ELSE NULL END) AS bulan_5'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 6 THEN 1 ELSE NULL END) AS bulan_6'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 7 THEN 1 ELSE NULL END) AS bulan_7'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 8 THEN 1 ELSE NULL END) AS bulan_8'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 9 THEN 1 ELSE NULL END) AS bulan_9'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 10 THEN 1 ELSE NULL END) AS bulan_10'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 11 THEN 1 ELSE NULL END) AS bulan_11'),
                                                \DB::raw('COUNT(CASE WHEN MONTH(created_at) = 12 THEN 1 ELSE NULL END) AS bulan_12'),
                                            )
                                            ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
                                            ->groupBy('kabupaten')
                                            ->get()
                                            ->toArray();
        return view('home', compact(
            'total_user',
            'total_laporan',
            'total_laporan_pasien',
            'total_laporan_prokes',
            'statistik_status_laporan',
            'statistik_wilayah_laporan',
        ));
    }

}
