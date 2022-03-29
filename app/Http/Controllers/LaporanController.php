<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\SPP;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index()
    {
        $spp = SPP::latest()->get();
        return view('admin.laporan', compact('spp'));
    }

    public function data(Request $request)
    {
        $data = Pembayaran::latest()->get();
        if($request->id_spp){
            $data = Pembayaran::where('spp_id', $request->id_spp);
        }
        if($request->dari){
            $data = Pembayaran::whereBetween('created_at', [$request->dari, $request->sampai])->get();
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($data) {
                $nama = Siswa::firstWhere('nisn', $data->nisn)->nama;
                return $nama;
            })
            ->addColumn('tanggal', function ($data) {
                $nama = tanggal($data->created_at) ;
                return $nama;
            })
            ->addColumn('id_spp', function ($data) {
                $nama = $data->spp->id_spp . ' - ' . $data->spp->tahun;
                return $nama;
            })
            ->addColumn('nominal', function ($data) {
                $nama = format_rupiah($data->jumlah_bayar);
                return $nama;
            })
            ->addColumn('petugas', function ($data) {
                $nama = $data->petugas->nama_petugas;
                return $nama;
            })
            ->addColumn('bulan', function ($data) {
                $nama = $data->bulan_dibayar . ' ' .$data->tahun_dibayar;
                return $nama;
            })
            ->rawColumns(['nama', 'tanggal', 'id_spp', 'nominal', 'petugas', 'bulan'])
            ->make(true);
    }
}
