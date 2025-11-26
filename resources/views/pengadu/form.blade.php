<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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
      <form action="{{ route('pengadu.pengaduan.store') }}" method="POST" enctype="multipart/form-data" id="pengaduanForm">
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
            <input type="file" name="bukti_foto" id="bukti_foto" accept="image/*" required>
            <small class="text-muted">Format: JPG, PNG (Maks. 3MB)</small>
          </div>
        </div>

        <div class="mb-4">
          <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian</label>
          <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" required>
        </div>

        <div class="mb-4">
          <label class="form-label">Lokasi Kejadian</label>

          <div class="map-instructions">
            <p>📍 <strong>Petunjuk:</strong> Ketik nama lokasi di bawah ini, klik pada peta, atau gunakan tombol GPS</p>
          </div>

          <!-- SEARCH BAR UNTUK CARI LOKASI -->
          <div class="location-search-container">
            <div class="search-wrapper">
              <input
                type="text"
                id="locationSearch"
                class="location-search-input"
                placeholder="🔍 Cari lokasi (contoh: Jl. Lambung Mangkurat, Banjarmasin)"
                autocomplete="off"
              >
              <button type="button" class="btn-search-location" id="btnSearchLocation">
                🔍 Cari
              </button>
            </div>
            <div id="searchResults" class="search-results"></div>
          </div>

          <button type="button" class="btn-get-location" id="btnGetLocation">
            📍 Gunakan Lokasi Saya
          </button>

          <div id="map"></div>

          <div class="location-info" id="locationInfo" style="display: none;">
            <p><strong>Alamat:</strong> <span id="addressDisplay">-</span></p>
            <p><strong>Koordinat:</strong> <span id="coordinatesDisplay">-</span></p>
          </div>

          <input type="hidden" name="lokasi_kejadian" id="lokasi_kejadian" required>
          <input type="hidden" name="latitude" id="latitude" required>
          <input type="hidden" name="longitude" id="longitude" required>
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

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/pengadu/form_pengaduan.js') }}"></script>

</body>
</html>
