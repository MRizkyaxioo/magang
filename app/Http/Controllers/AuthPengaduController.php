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
}
