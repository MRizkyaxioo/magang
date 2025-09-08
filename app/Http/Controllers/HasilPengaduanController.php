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
        // ambil daftar kategori pengaduan dari tabel pengaduan
        $kategori = Pengaduan::all();
        return view('pengadu.form', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengaduan'   => 'required|exists:pengaduan,id_pengaduan',
            'lokasi_kejadian' => 'required|string|max:100',
            'deskripsi'      => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'bukti_foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // ambil id pengadu dari akun yang login
        $data['id_pengadu'] = Auth::guard('pengadu')->id();

        // handle upload foto jika ada
        if ($request->hasFile('bukti_foto')) {
            $data['bukti_foto'] = $request->file('bukti_foto')->store('bukti_foto', 'public');
        }

        // status default
        $data['status'] = 'pending';

        HasilPengaduan::create($data);

        return redirect()->route('pengadu.riwayat')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function destroy($id)
{
    $pengaduan = HasilPengaduan::findOrFail($id);

    // Hapus file bukti_foto jika ada
    if ($pengaduan->bukti_foto && Storage::disk('public')->exists($pengaduan->bukti_foto)) {
        Storage::disk('public')->delete($pengaduan->bukti_foto);
    }

    $pengaduan->delete();

    return redirect()->back()->with('success', 'Pengaduan berhasil dihapus!');
}


}
