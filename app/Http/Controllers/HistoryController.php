<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();
        if(Auth::guard('siswa')->user()){
            $pembayaran = Pembayaran::where('nisn', Auth::guard('siswa')->user()->nisn)->with('petugas' , 'spp')->get();
        }
        $siswa = Siswa::get();
        return view('admin.history', compact('pembayaran', 'siswa'));
    }
}
