<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;

use Illuminate\Http\Request;

class DashboardPengaduController extends Controller
{
    public function index()
    {
        // Ambil hanya kolom kategori dan foto_illustrasi
        $pengaduan = Pengaduan::select('kategori')->get();

        return view('pengadu.dashboard', compact('pengaduan'));
    }
}
