<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SPP;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::with('kelas' , 'spp')->orderBy('nis', 'DESC')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::get();
        $spp = SPP::get();
        return view('admin.siswa.create', compact('kelas' , 'spp'));
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
            'nisn' => 'required|unique:siswa',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required'
        ], $message);

        Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas_id' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'spp_id' => $request->id_spp
        ]);
        return redirect(route('siswa.index'))->with([
            'pesan' => 'Berhasil ditambahkan',
            'pesan1', 'Siswa' .$request->nama. 'berhasil ditambahkan'
        ]);
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
        $siswa = Siswa::with('kelas' , 'spp')->findorfail($id);
        $kelas = Kelas::get();
        $spp = SPP::get();
        return view('admin.siswa.update', compact('siswa', 'kelas', 'spp'));

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
            'nisn' => 'required|unique:siswa,id,' . $id,
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required'
        ], $message);

        $user = Siswa::find($id);

        $user->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'spp_id' => $request->id_spp
        ]);
        return redirect(route('siswa.index'))->with([
            'pesan' => 'Berhasil diedit',
            'pesan1', 'Siswa' .$user->nama. 'berhasil diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete($id);
        return redirect(route('siswa.index'))->with([
            'pesan' => 'Berhasil dihapus',
            'pesan1'=> 'Data siswa ' . $siswa->nama . ' berhasil dihapus',
        ]);


    }
}
