<?php

namespace App\Http\Controllers;

use App\Models\Pengadu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthPengaduController extends Controller
{
    public function showRegisterForm()
    {
        return view('pengadu.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|size:16|unique:pengadu',
            'nama_pengadu' => 'required|string|max:100',
            'alamat' => 'required',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:pengadu',
            'password' => 'required|min:6|confirmed', // password_confirmation wajib
        ]);

        Pengadu::create([
            'nik' => $request->nik,
            'nama_pengadu' => $request->nama_pengadu,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pengadu.login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLoginForm()
    {
        return view('pengadu.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('pengadu')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-pengadu');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('pengadu')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pengadu.login');
    }

    // Method untuk menampilkan form ubah password
    public function showChangePasswordForm()
    {
        return view('pengadu.change-password');
    }

    // Method untuk memproses ubah password
    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.min' => 'Password baru minimal 6 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $pengadu = Auth::guard('pengadu')->user();

        // Cek apakah password lama benar
        if (!Hash::check($request->password_lama, $pengadu->password)) {
            return back()->withErrors([
                'password_lama' => 'Password lama tidak sesuai.'
            ]);
        }

        // Update password baru
        $pengadu->password = Hash::make($request->password_baru);
        $pengadu->save();

        // Logout otomatis setelah ubah password
        Auth::guard('pengadu')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pengadu.login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
    }

    // Tampilkan form edit profil
public function editProfile()
{
    $pengadu = Auth::guard('pengadu')->user();
    return view('pengadu.edit-profil', compact('pengadu'));
}

// Proses update profil
public function updateProfile(Request $request)
{
    $pengadu = Auth::guard('pengadu')->user();

    $request->validate([
        'nama_pengadu' => 'required|string|max:100',
        'alamat' => 'required|string|max:255',
        'no_telp' => 'required|string|max:20',
        'email' => 'required|email|unique:pengadu,email,' . $pengadu->id_pengadu . ',id_pengadu',
    ]);

    $pengadu->update([
        'nama_pengadu' => $request->nama_pengadu,
        'alamat' => $request->alamat,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
    ]);

    return redirect()->route('pengadu.edit-profil')->with('success', 'Profil berhasil diperbarui!');
}

}
