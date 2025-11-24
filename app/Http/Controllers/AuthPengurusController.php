<?php

namespace App\Http\Controllers;

use App\Models\HasilPengaduan;
use App\Models\Pengurus;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthPengurusController extends Controller
{
     // Form create pengurus
    public function create()
    {
        // ambil semua kategori dari tabel pengaduan
        $kategori = Pengaduan::all();
        return view('admin.create', compact('kategori'));
    }

    // Simpan data pengurus baru
    public function store(Request $request)
    {
        $request->validate([
            'instansi_pemerintahan' => 'required|string|max:255',
            'email'                 => 'required|email|unique:pengurus,email',
            'password'              => 'required|min:6|confirmed',
            'id_pengaduan'          => 'required|exists:pengaduan,id_pengaduan',
        ]);

        Pengurus::create([
            'instansi_pemerintahan' => $request->instansi_pemerintahan,
            'email'                 => $request->email,
            'password'              => Hash::make($request->password),
            'id_pengaduan'          => $request->id_pengaduan, // kategori yang dipilih
            'id_hasil'              => null, // opsional
        ]);

        return redirect()->route('pengurus.create')->with('success', 'Akun pengurus berhasil dibuat.');
    }

    // List semua pengurus
    public function index()
    {
        $pengurus = Pengurus::with('pengaduan')->get();
        return view('pengurus.index', compact('pengurus'));
    }

    public function showLoginForm()
    {
        return view('pengurus.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('pengurus')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-pengurus');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pengurus.login');
    }

    // Form ubah password
    public function showChangePasswordForm()
    {
        return view('pengurus.change-password');
    }

    // Proses ubah password
    public function changePassword(Request $request)
    {
        $request->validate([
    'current_password' => 'required',
    'new_password'     => 'required|min:6|confirmed',
], [
    'current_password.required' => 'Password lama wajib diisi.',
    'new_password.required'     => 'Password baru wajib diisi.',
    'new_password.min'          => 'Password baru minimal 6 karakter.',
    'new_password.confirmed'    => 'Konfirmasi password baru tidak sesuai.',
]);


        $pengurus = Auth::guard('pengurus')->user();

        // Cek password lama
        if (!Hash::check($request->current_password, $pengurus->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        // Update password
        $pengurus->password = Hash::make($request->new_password);
        $pengurus->save(); // ✅ Pastikan model Pengurus extend Authenticatable

        // Logout otomatis
        Auth::guard('pengurus')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pengurus.login')->with('success', 'Password berhasil diubah, silakan login ulang.');
    }

}
