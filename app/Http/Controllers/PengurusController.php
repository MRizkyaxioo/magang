<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPengaduan;

class PengurusController extends Controller
{
    public function index()
    {
        // Ambil pengurus yang login
        $pengurus = auth('pengurus')->user();

        // Ambil id_pengaduan yang dimiliki pengurus (kategori yang dia handle)
        $idPengaduan = $pengurus->id_pengaduan;

        // Ambil data dengan pagination, urutkan terbaru
    $hasilPengaduan = HasilPengaduan::where('id_pengaduan', $idPengaduan)
        ->orderBy('created_at', 'desc') // urutkan terbaru
        ->paginate(5); // maksimal 5 per halaman

        return view('pengurus.dashboard', compact('hasilPengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,ditolak,sedang dikerjakan,selesai',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $pengurus = auth('pengurus')->user();


        // Cari pengaduan yang sesuai dengan kategori milik pengurus
        $pengaduan = HasilPengaduan::where('id_hasil', $id)
            ->where('id_pengaduan', $pengurus->id_pengaduan)
            ->firstOrFail();

        // Update status
        $pengaduan->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengurus.dashboard')->with('success', 'Status berhasil diperbarui');
    }

    public function show($id)
{
    $pengurus = auth('pengurus')->user();

    // Cari hasil pengaduan berdasarkan id dan kategori yang sesuai
    $hasilPengaduan = HasilPengaduan::with(['pengadu', 'pengaduan'])
        ->where('id_hasil', $id)
        ->where('id_pengaduan', $pengurus->id_pengaduan)
        ->firstOrFail();

    return view('pengurus.show', compact('hasilPengaduan'));
}


}
