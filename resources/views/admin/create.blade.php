<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Pengurus - SIPAMA</title>
    <link href="{{ asset('css/admin/create.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="main-title">Buat Akun Pengurus</h1>

            <!-- Error Messages (Hidden by default) -->
            <div class="alert-danger" id="errorAlert" style="display: none;">
                <ul id="errorList">
                    <!-- Error messages will be populated here -->
                </ul>
            </div>

            <form id="registrationForm" action="{{ route('pengurus.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="instansi">Nama Instansi</label>
                    <input type="text"
                           id="instansi"
                           name="instansi_pemerintahan"
                           class="form-input"
                           placeholder="Masukkan nama instansi pemerintahan"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Pengurus</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-input"
                           placeholder="contoh@instansi.go.id"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-input"
                           placeholder="Masukkan password yang kuat"
                           required>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-input"
                           placeholder="Ulangi password yang sama"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="kategori">Kategori Pengaduan</label>
                    <select id="kategori" name="id_pengaduan" class="form-select" required>
                        <option value="">-- Pilih Kategori Pengaduan --</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id_pengaduan }}">{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn-primary" id="submitBtn">
                        Buat Akun
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
                        Kembali ke dashboard
                    </a>
                </div>
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

<script src="{{ asset('js/admin/create.js') }}"></script>
</body>
</html>