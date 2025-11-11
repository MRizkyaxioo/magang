<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('admin.kategori', compact('pengaduans'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:15',
        ]);

        $data = $request->only(['kategori']);


        Pengaduan::create($data);

        return redirect()->route('pengaduan.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        return view('admin.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $request->validate([
            'kategori' => 'required|string|max:15',
        ]);

        $data = $request->only(['kategori']);


        $pengaduan->update($data);

        return redirect()->route('pengaduan.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
