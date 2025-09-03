<?php

namespace App\Http\Controllers;

use App\Models\HasilPengaduan;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $hasil = HasilPengaduan::with(['pengadu', 'pengaduan'])->get();
        return view('admin.dashboard', compact('hasil'));
    }

    public function updateStatus(Request $request, $id)
    {
        $hasil = HasilPengaduan::findOrFail($id);
        $hasil->status = $request->status;
        $hasil->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function show($id)
    {
        $hasil = HasilPengaduan::with(['pengadu', 'pengaduan'])->findOrFail($id);
        return view('admin.show', compact('hasil'));
    }

    public function updateKategori(Request $request, $id)
{
    $request->validate([
        'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
    ]);

    $hasil = HasilPengaduan::findOrFail($id);
    $hasil->id_pengaduan = $request->id_pengaduan;
    $hasil->save();

    return redirect()->back()->with('success', 'Kategori pengaduan berhasil diperbarui!');
}

}
