<?php

namespace App\Http\Controllers;

use App\Models\HasilPengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {

        // Query untuk data yang akan ditampilkan (dengan filter)
        $query = HasilPengaduan::with(['pengadu', 'pengaduan.pengurus']);

         // Filter status
    if ($request->filled('status') && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    // Filter kategori
    if ($request->filled('kategori') && $request->kategori !== 'all') {
        $query->whereHas('pengaduan', function($q) use ($request) {
            $q->where('kategori', $request->kategori);
        });
    }

    // Filter pengurus
    if ($request->filled('pengurus') && $request->pengurus !== 'all') {
        $query->whereHas('pengaduan.pengurus', function ($q) use ($request) {
            $q->where('instansi_pemerintahan', 'LIKE', '%' . $request->pengurus . '%');
        });
    }

    // FILTER BULAN
if ($request->filled('bulan')) {
    $bulan = date('m', strtotime($request->bulan));
    $tahun = date('Y', strtotime($request->bulan));

    $query->whereMonth('created_at', $bulan)
          ->whereYear('created_at', $tahun);
}


        // Paginate dengan 5 item per halaman
        $hasil = $query->latest('created_at')->paginate(5)->appends($request->query());

        $allQuery = HasilPengaduan::with(['pengadu', 'pengaduan.pengurus']);

// Jika ada filter bulan → statistik ikut difilter
if ($request->filled('bulan')) {
    $bulan = date('m', strtotime($request->bulan));
    $tahun = date('Y', strtotime($request->bulan));

    $allQuery->whereMonth('created_at', $bulan)
             ->whereYear('created_at', $tahun);
}

$allHasil = $allQuery->get();


        return view('admin.dashboard', [
        'hasil' => $hasil,
        'allHasil' => $allHasil,
        'status' => $request->status,
        'kategori' => $request->kategori,
        'pengurus' => $request->pengurus,
    ]);
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


public function updateKeterangan(Request $request, $id)
{
    $hasil = HasilPengaduan::findOrFail($id);

    // field tidak wajib diisi → jadi cukup pakai nullable
    $hasil->keterangan = $request->keterangan ?? null;
    $hasil->save();

    return redirect()->back()->with('success', 'Keterangan berhasil diperbarui!');
}



public function statistikPDF(Request $request)
{
    $request->validate([
        'bulan' => 'required'
    ]);

    $bulan = date('m', strtotime($request->bulan));
    $tahun = date('Y', strtotime($request->bulan));

    \Carbon\Carbon::setLocale('id');

    $namaBulan = \Carbon\Carbon::parse($request->bulan)->translatedFormat('F');
    $bulanLabel = $namaBulan . ' Tahun ' . $tahun;


    $data = HasilPengaduan::whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->get();

    $statistik = [
        'pending' => $data->where('status', 'pending')->count(),
        'sedang'  => $data->where('status', 'sedang dikerjakan')->count(),
        'selesai' => $data->where('status', 'selesai')->count(),
        'ditolak' => $data->where('status', 'ditolak')->count(),
        'total'   => $data->count(),
    ];

    return Pdf::loadView('admin.statistik', [
    'statistik'   => $statistik,
    'bulan'       => $request->bulan,
    'bulanLabel' => $bulanLabel
])->download('statistik_pengaduan_' . $request->bulan . '.pdf');

}
    }
