<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\HasilPengaduan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardPengaduController extends Controller
{
    public function index()
    {
        // Ambil hanya kolom kategori
        $pengaduan = Pengaduan::select('kategori')->get();

        return view('pengadu.dashboard', compact('pengaduan'));
    }

    public function history()
    {
 // Ambil user yang login lewat guard pengadu
        $user = Auth::guard('pengadu')->user();

        // Filter data hasil_pengaduan sesuai id_pengadu user
        // $riwayat = HasilPengaduan::where('id_pengadu', $user->id_pengadu)->get();

        // Tambahkan pagination (10 item per halaman)
        $riwayat = HasilPengaduan::where('id_pengadu', $user->id_pengadu)
            ->with('pengaduan')
            ->latest('created_at') // Urutkan dari yang terbaru
            ->paginate(5);

        return view('pengadu.riwayat', compact('riwayat'));
    }
}


