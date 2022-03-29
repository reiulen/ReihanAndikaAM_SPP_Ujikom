<?php

namespace App\Http\Controllers;

use App\Models\SPP;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SPPController extends Controller
{
    public function index()
    {
        $spp = SPP::orderBy('id_spp', 'DESC')->first();
        return view('admin.spp.index', compact('spp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'tahun' => 'required',
            'nominal' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        $user = Spp::find($request->id);
        if($user){
            $nominal = preg_replace("/[^0-9]/", "", $request->nominal);
            $user->update([
                'tahun' => $request->tahun,
                'nominal' => $nominal
            ]);
        }else{
            $nominal = preg_replace("/[^0-9]/", "", $request->nominal);

            Spp::create([
                'id_spp' => $request->id_spp,
                'tahun' => $request->tahun,
                'nominal' => $nominal
            ]);
        }
        return response()->json('SPP ' . $request->id_spp . ' ' . $request->tahun . ' berhasil disimpan');
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
        $spp = SPP::findorfail($id);
        return response()->json($spp);

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp = SPP::find($id);
        $spp->delete($id);
        return response()->json([
            'SPP ' . $spp->id_spp . ' ' . $spp->tahun . ' berhasil dihapus'
        ]);
    }

    public function data()
    {
        $data = Spp::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nominal', function ($data) {
                $button = format_rupiah($data->nominal);
                return $button;
            })
            ->addColumn('aksi', function ($data) {
                $button = "<div class='dropdown'>
                                    <button class='btn btn-none' id='kelasdrop" . $data->id . "' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                      <i class='fas fa-ellipsis-v' type='button'></i>
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='kelassdrop" . $data->id . "'>
                                        <a class='dropdown-item btn-edit' href='#' data-id='" . $data->id . "'><i class='fa fa-edit'></i>&nbsp; Edit Kelas</a>
                                        <a class='dropdown-item btnhapus' data-id='" . $data->id . "' data-nama='" . $data->id_spp . " " . $data->tahun . "' href='#'><i class='fa fa-trash'></i>&nbsp; Hapus</a>
                                    </div>
                                </div>";
                return $button;
            })
            ->rawColumns(['aksi', 'nominal'])
            ->make(true);
    }
}
