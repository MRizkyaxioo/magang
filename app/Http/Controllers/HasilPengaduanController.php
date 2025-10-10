<?php

namespace App\Http\Controllers;

use App\Models\HasilPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HasilPengaduanController extends Controller
{
    public function create()
    {
        $kategori = Pengaduan::all();
        return view('pengadu.form', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengaduan'     => 'required|exists:pengaduan,id_pengaduan',
            'lokasi_kejadian'  => 'required|string|max:255',
            'latitude'         => 'required|numeric|between:-90,90',      // TAMBAHKAN
            'longitude'        => 'required|numeric|between:-180,180',    // TAMBAHKAN
            'deskripsi'        => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'bukti_foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:3048',
        ]);

        $data = $request->all();
        $data['id_pengadu'] = Auth::guard('pengadu')->id();

        if ($request->hasFile('bukti_foto')) {
            $data['bukti_foto'] = $request->file('bukti_foto')->store('bukti_foto', 'public');
        }

        $data['status'] = 'pending';

        HasilPengaduan::create($data);

        return redirect()->route('pengadu.riwayat')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function destroy($id)
    {
        $pengaduan = HasilPengaduan::findOrFail($id);

        if ($pengaduan->bukti_foto && Storage::disk('public')->exists($pengaduan->bukti_foto)) {
            Storage::disk('public')->delete($pengaduan->bukti_foto);
        }

        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus!');
    }
}