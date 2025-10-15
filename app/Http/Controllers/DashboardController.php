<?php

namespace App\Http\Controllers;

use App\Models\HasilPengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data untuk statistik
        $hasil = HasilPengaduan::with(['pengadu', 'pengaduan'])->get();

        // Ambil hanya data yang status-nya pending (dengan relasi kategori)
        $pending = HasilPengaduan::with(['pengadu', 'pengaduan'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(4); // tampilkan 4 data per halaman

        // Kirim ke view
        return view('guest.dashboard', compact('hasil', 'pending'));
    }
}
