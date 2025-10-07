<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Pengadu</title>
    <link rel="stylesheet" href="{{ asset('css/pengadu/dashboard.css') }}">
    <style>
        /* ========== POPUP STYLING ========== */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(3px);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 30px;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .close-btn {
            cursor: pointer;
            font-size: 22px;
            color: #888;
            transition: color 0.2s;
        }

        .close-btn:hover {
            color: #000;
        }

        .modal form input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
        }

        .modal form button {
            background-color: #667eea;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            transition: 0.3s;
        }

        .modal form button:hover {
            background-color: #5a6edc;
        }

        .error-message {
            color: red;
            font-size: 13px;
        }

    .password-field {
    position: relative;
    display: flex;
    align-items: center;
}

.password-field input {
    width: 100%;
    padding-right: 35px;
}

.toggle-password {
    position: absolute;
    right: 10px;
    cursor: pointer;
    user-select: none;
    font-size: 18px;
    opacity: 0.7;
    transition: opacity 0.2s ease;
}

.toggle-password:hover {
    opacity: 1;
}
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo-section">
                <img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo">
                <h1>Edit Profil Anda</h1>
            </div>
        </header>

        <main class="main-content" style="max-width:600px;margin:auto;">
            @if(session('success'))
                <div style="background:#c8f7c5;padding:10px;border-radius:8px;margin-bottom:15px;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('pengadu.update-profil') }}">
                @csrf
                <div class="form-group">
                    <label>NIK (tidak dapat diubah)</label>
                    <input type="text" value="{{ $pengadu->nik }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama_pengadu" value="{{ old('nama_pengadu', $pengadu->nama_pengadu) }}" required>
                    @error('nama_pengadu') <small style="color:red;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" required>{{ old('alamat', $pengadu->alamat) }}</textarea>
                    @error('alamat') <small style="color:red;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $pengadu->no_telp) }}" required>
                    @error('no_telp') <small style="color:red;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $pengadu->email) }}" required>
                    @error('email') <small style="color:red;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Tempat Lahir (tidak dapat diubah)</label>
                    <input type="text" value="{{ $pengadu->tempat_lahir }}" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir (tidak dapat diubah)</label>
                    <input type="text" value="{{ $pengadu->tanggal_lahir }}" disabled>
                </div>

                <div style="display:flex;justify-content:space-between;margin-top:20px;">
                    <button type="submit" class="complaint-button">💾 Simpan Perubahan</button>
                </div>
            </form>

            <!-- Tombol Ganti Password -->
            <button class="complaint-button" onclick="openModal()">🔒 Ganti Password</button>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('pengadu.logout') }}">
                @csrf
                <button type="submit" class="complaint-button" style="background:red;">🚪 Logout</button>
            </form>
        </main>
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


                <button type="submit">Ubah Password</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('passwordModal').style.display = 'block';
        }
        function closeModal() {
            document.getElementById('passwordModal').style.display = 'none';
        }

        // Tutup modal jika klik di luar kotak
        window.onclick = function(event) {
            const modal = document.getElementById('passwordModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈"; // Ganti ikon kalau password sedang ditampilkan
    } else {
        input.type = "password";
        icon.textContent = "👁️"; // Balik lagi
    }
}
    </script>
</body>
</html>
