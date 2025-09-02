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

}
