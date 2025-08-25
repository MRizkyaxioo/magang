<?php

namespace App\Http\Controllers;

use App\Models\Pengadu;
use Illuminate\Http\Request;

class AdminPengaduController extends Controller
{
    public function index()
    {
        // Ambil semua pengadu beserta hasil pengaduannya
        $pengadu = Pengadu::with('hasilPengaduan')->get();

        return view('admin.pengadu.index', compact('pengadu'));
    }

    public function show($id)
    {
        // Detail satu pengadu + hasil pengaduannya
        $pengadu = Pengadu::with('hasilPengaduan')->findOrFail($id);

        return view('admin.pengadu.show', compact('pengadu'));
    }
}
