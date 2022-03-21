<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'kompetensi_keahlian' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        Kelas::create([
            'nama_kelas' => $request->kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);
        return response()->json('Kelas ' . $request->kelas . ' ' . $request->kompetensi_keahlian . ' berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::findorfail($id);
        return response()->json($kelas);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'kompetensi_keahlian' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $user = Kelas::find($id);

        $user->update([
            'nama_kelas' => $request->kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);
        return response()->json('Kelas ' . $request->kelas . ' ' . $request->kompetensi_keahlian . ' berhasil diubah');
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete($id);
        return response()->json([
            'pesan' => 'Kelas ' . $kelas->nama_kelas . ' ' . $kelas->kompetensi_keahlian . ' berhasil dihapus',
        ]);
    }

    public function data()
    {
        $data = Kelas::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $button = "<div class='dropdown'>
                                    <button class='btn btn-none' id='kelasdrop" . $data->id . "' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> 
                                      <i class='fas fa-ellipsis-v' type='button'></i>
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='kelassdrop" . $data->id . "'>
                                        <a class='dropdown-item btn-edit' href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i>&nbsp; Edit Kelas</a>
                                        <a class='dropdown-item btnhapus' data-id='" . $data->id . "' data-nama='" . $data->nama_kelas . " " . $data->kompetensi_keahlian . "' href='#'><i class='fa fa-trash'></i>&nbsp; Hapus</a>
                                    </div>
                                </div>";
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
