<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.tambah_kelas');
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
            'kelas' => 'required',
            'kompeten' => 'required'
        ], $message);

        Kelas::create([
            'kelas' => $request->kelas,
            'kompeten' => $request->kompeten,
        ]);
        return redirect('/kelas')->with('pesan', 'Kelas berhasil ditambahkan');
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
        $kelas = Kelas::findorfail($id);
        return view('kelas.edit_kelas', compact('kelas'));
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
            'kelas' => 'required',
            'kompeten' => 'required'
        ], $message);

        $user = Kelas::find($id);

        $user->update([
            'kelas' => $request->kelas,
            'kompeten' => $request->kompeten,
        ]);
        return redirect('/kelas')->with('pesan', 'Kelas berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete($id);
        return redirect('/kelas')->with([
            'pesan'=> 'Data Kelas ' . $kelas->nama_kelas . $kelas->kompeten . ' berhasil dihapus',
        ]);
    }

    public function data()
    {
        $data = Kelas::latest()->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $button = "<div class='dropdown'>
                                    <button class='btn btn-none' id='petugasdrop" .$data->id ."' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <i class='fas fa-ellipsis-v' type='button'></i></button>
                                    <div class='dropdown-menu' aria-labelledby='petugasdrop" .$data->id ."'>
                                        <a class='dropdown-item' href='" .route('petugas.edit', $data->id) ."'><i class='fa fa-edit'></i>&nbsp; Edit Petugas</a>
                                        <a class='dropdown-item' data-toggle='modal' data-target='#modalpetugas" .$data->id ."' href='#'><i class='fa fa-eye'></i>&nbsp; Lihat Detail</a>
                                        <a class='dropdown-item btnhapus' data-id='" .$data->id ."' data-nama=".$data->nama_kelas . ' ' . $data->kompetensi_keahlian." href='#'><i class='fa fa-trash'></i>&nbsp; Hapus</a>
                                    </div>
                                </div>";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
}
