<?php

namespace App\Http\Controllers;

use App\Models\HasilPengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hasil = HasilPengaduan::with(['pengadu', 'pengaduan'])->get();
        return view('guest.dashboard', compact('hasil'));
    }
}
