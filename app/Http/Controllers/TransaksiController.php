<?php

namespace App\Http\Controllers;

use App\Models\SPP;
use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('petugas' , 'spp')->get();
        $siswa = Siswa::get();
        return view('admin.transaksi.index', compact('pembayaran', 'siswa'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $petugas = Petugas::get();
        $spp = SPP::get();
        $siswa = Siswa::orderByDesc('nis')->get();
        $pembayaran = Pembayaran::orderBy('id_pembayaran', 'DESC')->first();
        return view('admin.transaksi.create', compact('petugas' , 'spp', 'siswa', 'pembayaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'Belum diisi',
            'unique' => 'Tidak boleh sama!'
        ];

        $request->validate([
            'id_pembayaran' => 'required|unique:pembayarans',
            'nama' => 'required',
            'jumlah_bayar' => 'required',
            'bultahun' => 'required',
        ], $message);

        $nominal = preg_replace("/[^0-9]/", "", $request->jumlah_bayar);
        $siswa = Siswa::findorfail($request->nama);
        $tahun = tahun($request->butahun);
        $bulan = bulan($request->bultahun);

        Pembayaran::create([
            'id_pembayaran' => $request->id_pembayaran,
            'petugas_id' => Auth::user()->id,
            'nisn' => $siswa->nisn,
            'tgl_bayar' => date('d'),
            'bulan_dibayar' => $bulan,
            'tahun_dibayar' => $tahun,
            'spp_id' => $siswa->spp_id,
            'jumlah_bayar' => $nominal,
        ]);
        return redirect(route('transaksi.index'))->with('pesan', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::findorfail($id);
        $petugas = Petugas::get();
        $spp = SPP::get();
        $siswa = Siswa::orderByDesc('nis')->get();
        return view('admin.transaksi.update', compact('pembayaran' , 'petugas', 'spp', 'siswa'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = [
            'required' => 'Belum diisi',
            'unique' => 'Tidak boleh sama!'
        ];

        $request->validate([
            'nama' => 'required',
            'jumlah_bayar' => 'required',
            'bultahun' => 'required'
        ], $message);

        $nominal = preg_replace("/[^0-9]/", "", $request->jumlah_bayar);
        $siswa = Siswa::findorfail($request->nama);

        $pembayaran = Pembayaran::findorfail($id);
        $tahun = tahun($request->butahun);
        $bulan = bulan($request->bultahun);

        $pembayaran->update([
            'petugas_id' => Auth::user()->id,
            'nisn' => $siswa->nisn,
            'tgl_bayar' => date('d'),
            'bulan_dibayar' => $bulan,
            'tahun_dibayar' => $tahun,
            'spp_id' => $siswa->spp_id,
            'jumlah_bayar' => $nominal,
        ]);

        return redirect(route('transaksi.index'))->with('pesan', 'Pembayaran berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete($id);
        return redirect(route('transaksi.index'))->with([
        'pesan'=> 'Data Pembayaran ' . $pembayaran->id_pembayaran . ' berhasil dihapus',
        ]);

    }
}
