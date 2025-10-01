<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pengadu/form_pengaduan.css') }}">
</head>
<body>

<div class="container">
  <!-- Logo Section -->
  <div class="row">
    <div class="col-12">
      <img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo d-block d-md-absolute">
    </div>
  </div>

  <!-- Header Section -->
  <div class="header">
    <h3>SELAMAT DATANG DI SIPAMA</h3>
    <p>Sampaikan laporan Anda langsung ke instansi yang berwenang</p>
  </div>

  <!-- Form Container -->
  <div class="form-container">
    <div class="form-header">SAMPAIKAN LAPORAN ANDA</div>
    <div class="form-content">
      <form action="{{ route('pengadu.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label for="id_pengaduan" class="form-label">Kategori laporan</label>
          <select name="id_pengaduan" id="id_pengaduan" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
              <option value="{{ $k->id_pengaduan }}">{{ $k->kategori }}</option>
            @endforeach
          </select>
        </div>

        <div class="row mb-4">
          <div class="col-md-8">
            <label for="deskripsi" class="form-label">Deskripsi laporan</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" required placeholder="Jelaskan secara detail laporan Anda..."></textarea>
          </div>
          <div class="col-md-4">
            <label for="bukti_foto" class="form-label">Bukti foto</label>
            <input type="file" name="bukti_foto" id="bukti_foto" accept="image/*">
            <small class="text-muted">Format: JPG, PNG (Maks. 3MB)</small>
          </div>
        </div>

        <div class="mb-4">
          <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian</label>
          <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" required>
        </div>

        <div class="mb-4">
          <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian</label>
          <input type="text" name="lokasi_kejadian" id="lokasi_kejadian" required placeholder="Contoh: Jl. Lambung Mangkurat No. 123, Banjarmasin">
        </div>

        <!-- Tombol sejajar -->
        <div class="btn-container">
          <a href="{{ route('pengadu.dashboard') }}" class="back-btn">⬅ Kembali ke Dashboard</a>
          <button type="submit" class="btn btn-lapor">📝 LAPOR!</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{ asset('js/pengadu/form_pengaduan.js') }}"></script>
</body>
</html>
