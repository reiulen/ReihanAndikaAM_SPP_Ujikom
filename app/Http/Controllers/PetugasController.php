<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::where('level', '!=', 'Admin')->latest()->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $petugas = Petugas::orderBy('id_petugas', 'DESC')->first();
        return view('admin.petugas.create', compact('petugas'));
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
            'required' => 'Tidak boleh kosong',
            'min' => 'Terlalu pendek',
            'max' => 'Terlalu panjang',
            'unique' => 'Tidak boleh sama',
            'same' => 'Password tidak sama!'
        ];
        $request->validate([
            'id_petugas' => 'required|unique:petugas',
            'username' => 'required|min:4|max:10|unique:petugas',
            'nama_petugas' => 'required',
            'level' => 'required',
            'password' => 'required_with:password1|same:password1|min:4|max:12',
            'password1' => 'min:4|max:12'
        ], $message);

        Petugas::create([
            'id_petugas' => $request->id_petugas,
            'username' => $request->username,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
            'password' => bcrypt($request->password),
        ]);

        return redirect(route('petugas.index'))->with([
            'pesan' => 'Berhasil ditambahkan',
            'pesan1' => 'Petugas ' .$request->nama_petugas. ' berhasil ditambahkan'
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
        $petugas = Petugas::findorfail($id);
        $petugas->delete($petugas->id);
        return response()->json('Berhasil dihapus');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $petugas = Petugas::findorFail($id);
        return view('admin.petugas.update', compact('petugas'));
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
            'required' => 'Tidak boleh kosong',
            'min' => 'Terlalu pendek',
            'max' => 'Terlalu panjang',
            'unique' => 'Tidak boleh sama'
        ];
        $request->validate([
            'id_petugas' => 'required|unique:petugas,id_petugas,' . $id,
            'username' => 'required|min:4|max:10|unique:petugas,username,' . $id,
            'nama_petugas' => 'required',
            'level' => 'required'
        ], $message);

        $user = Petugas::find($id);

        if($request->password){
            $password = bcrypt($request->password);
        }else{
            $password = $user->password;
        }

        $user->update([
            'id_petugas' => $request->id_petugas,
            'username' => $request->username,
            'password' => $user->password,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
            'password' => $password,
        ]);

        return redirect(route('petugas.index'))->with([
            'pesan' => 'Berhasil diubah',
            'pesan1' => 'Petugas ' .$request->nama_petugas. ' berhasil diubah'
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
        //
    }

    public function data()
    {
        $data = Petugas::where('level', '!=', 'Admin')->latest()->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('level', function($data){
                    $button = "<span class='badge ".badgelevel($data->level)."'>". $data->level."</span>";
                    return $button;
                })
                ->addColumn('aksi', function($data){
                    $button = "<div class='dropdown'>
                                    <button class='btn btn-none' id='petugasdrop" .$data->id ."' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <i class='fas fa-ellipsis-v' type='button'></i></button>
                                    <div class='dropdown-menu' aria-labelledby='petugasdrop" .$data->id ."'>
                                        <a class='dropdown-item' href='" .route('petugas.edit', $data->id) ."'><i class='fa fa-edit'></i>&nbsp; Edit Petugas</a>
                                        <a class='dropdown-item' data-toggle='modal' data-target='#modalpetugas" .$data->id ."' href='#'><i class='fa fa-eye'></i>&nbsp; Lihat Detail</a>
                                        <a class='dropdown-item btnhapus' data-id='" .$data->id ."' data-nama=".$data->nama_petugas." href='#'><i class='fa fa-trash'></i>&nbsp; Hapus</a>
                                    </div>
                                </div>";
                    return $button;
                })
                ->rawColumns(['level','aksi'])
                ->make(true);
    }
}
