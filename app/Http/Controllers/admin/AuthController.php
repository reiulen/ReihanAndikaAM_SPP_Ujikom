<?php

namespace App\Http\Controllers\admin;

use App\Models\Siswa;
use App\Models\Petugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function proseslogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $user = Petugas::where('username', $request->username)->first();
            $request->session()->regenerate();
            Auth::guard('petugas')->login($user);
            return redirect()->intended(route('dashboard'));
        }
        return back()->with([
            'pesan' => 'username/password salah',
            'type' => 'pengelola',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::guard('petugas')->logout();
        return redirect('/');
    }

    public function indexsiswa()
    {
        return view('siswalogin');
    }

    public function loginsiswa(Request $request)
    {
        $message = [
            'required' => 'Tidak boleh kosong!',
            'max' => 'Tidak valid!',
            'min' => 'Tidak valid!'
        ];
        $request->validate([
            'nis' => 'required|max:9|min:9',
        ], $message);

        $siswa = Siswa::firstWhere('nis', $request->nis);
        if($siswa){
            Auth::guard('siswa')->login($siswa);
            return redirect(route('history'));
        }
        return back()->with([
            'pesan' => 'Nis tidak ditemukan!'
        ]);
    }
}
