<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::get();
        return view('admin.dashboard', compact('pembayaran'));
    }
}
