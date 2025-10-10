<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Anda</title>
<link rel="stylesheet" href="{{ asset('css/pengadu/profil.css') }}">
</head>
<body>
<div class="container">
<header class="header">
<div class="logo-section">
<img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo">
<h1 class="profil-title">Profil Anda</h1>
</div>
<form method="POST" action="{{ route('pengadu.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">↪ Logout</button>
            </form>

</header>
<div class="content">
<div class="info-box">
<h3>Informasi Data Pribadi</h3>
<p>Untuk pelayanan aduan yang tepat, silakan menginputkan nama, email dan nomor HP yang benar.</p>
<p>Demi kenyamanan dan keamanan Anda (Pengadu), data pribadi Anda akan kami rahasiakan sesuai Kebijakan Privasi dari pihak SIPAMA.</p>
</div>

<form method="POST" action="{{ route('pengadu.update-profil') }}" id="profileForm">
@csrf
<div class="form-group">
<label>NIK *</label>
<input type="text" value="{{ $pengadu->nik }}" disabled>
</div>

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama_pengadu" value="{{ old('nama_pengadu', $pengadu->nama_pengadu) }}" id="nama"  required>
</div>

<div class="form-group">
<label>Alamat</label>
<textarea id="alamat" name="alamat" required>{{ old('alamat', $pengadu->alamat) }}</textarea>
</div>

<div class="form-group">
<label>No. Telpon</label>
<input type="tel" id="telpon" name="no_telp" value="{{ old('no_telp', $pengadu->no_telp) }}" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" id="email" name="email" value="{{ old('email', $pengadu->email) }}" required>
</div>

<div class="form-group">
<label>Tempat Lahir *</label>
<input type="text" value="{{ $pengadu->tempat_lahir }}" disabled>
</div>

<div class="form-group">
<label>Tanggal Lahir *</label>
<input type="text" value="{{ $pengadu->tanggal_lahir }}" disabled>
</div>

<div class="button-group">
    <a href="{{ route('pengadu.dashboard') }}" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>

<button type="submit" class="btn btn-primary">
<span>💾</span>
Simpan Perubahan
</button>
<button type="button" class="btn btn-primary" onclick="openModal()">
<span>🔒</span>
Ganti Password
</button>
</div>
</form>
</div>
</div>

<!-- ========== MODAL GANTI PASSWORD ========== -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>🔐 Ubah Password</h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>

            <p style="font-size:13px;color:#555;margin-bottom:10px;">
                Setelah password diubah, Anda akan otomatis logout.
            </p>

            <form method="POST" action="{{ route('pengadu.change-password') }}">
                @csrf

                <label>Password Lama</label>
<div class="password-field">
    <input type="password" id="password_lama" name="password_lama" required>
    <span class="toggle-password" onclick="togglePassword('password_lama', this)">👁️</span>
    @error('password_lama') <div class="error-message">{{ $message }}</div> @enderror
</div>

<label>Password Baru</label>
<div class="password-field">
    <input type="password" id="password_baru" name="password_baru" required minlength="6">
    <span class="toggle-password" onclick="togglePassword('password_baru', this)">👁️</span>
    @error('password_baru') <div class="error-message">{{ $message }}</div> @enderror
</div>

<label>Konfirmasi Password Baru</label>
<div class="password-field">
    <input type="password" id="password_baru_confirmation" name="password_baru_confirmation" required>
    <span class="toggle-password" onclick="togglePassword('password_baru_confirmation', this)">👁️</span>
</div>


                <button type="submit" class="btn btn-primary" style="margin-top: 10px;" >Ubah Password</button>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#8B4513',
    confirmButtonText: 'OK'
});
</script>
@endif

<script src="{{ asset('js/pengadu/profil.js') }}"></script>


</body>
</html>