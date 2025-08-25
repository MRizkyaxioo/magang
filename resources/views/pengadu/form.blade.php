<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
   body {
      background: linear-gradient(to right, #fff7a1, #ffcc00); /* Latar belakang kuning */
      min-height: 100vh;
      position: relative;
      padding-top: 120px; /* beri jarak dari atas agar form tidak menutupi logo */
    }
    .logo {
  position: absolute;
  top: 70px;
  left: 200px;
  width: 250px;   /* lebar custom */
  height: 200px;  /* tinggi custom */
  object-fit: contain; /* biar gambar tetap bagus */
}

    .form-container {
      max-width: 700px;
      margin: 0 auto;
      border: 1px solid #ccc;
      border-radius: 10px;
      background: #fffbea; /* kuning lembut di dalam form */
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    .form-header {
      background: yellow;
  padding: 15px;
  font-size: 30px;
  font-weight: bold;
  text-align: left;
  width: 90%;         /* kiri & kanan terpotong */
  margin: 10px auto;  /* atas-bawah juga terpotong */
  border-radius: 5px; /* opsional */
    }
    .btn-lapor {
      background-color: yellow;
      font-weight: bold;
      border: none;
      padding: 10px 25px;
      border-radius: 5px;
    }
    .btn-lapor:hover {
      background-color: #f0e600;
    }
    select, textarea, input[type="text"], input[type="date"], input[type="file"] {
      width: 100%;
      border: 1px solid #555;
      padding: 8px;
      border-radius: 3px;
    }
     .header {
      text-align: center;
      margin-bottom: 20px;
        }

  </style>
</head>
<body>

<div class="container mt-4">
  <div class="row align-items-center mb-3">
    <div class="col-md-2 text-center">
      <!-- Logo -->
      <img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo">
    </div>
    <div class="header">
      <h3 class="fw-bold">SELAMAT DATANG DI SIMARA</h3>
      <p>Sampaikan laporan Anda langsung ke instansi yang berwenang</p>
    </div>
  </div>

  <div class="form-container shadow-sm">
    <div class="form-header">SAMPAIKAN LAPORAN ANDA</div>
    <div class="p-3">
      <form action="{{ route('pengadu.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="id_pengaduan" class="form-label">Kategori laporan</label>
          <select name="id_pengaduan" id="id_pengaduan" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
              <option value="{{ $k->id_pengaduan }}">{{ $k->kategori }}</option>
            @endforeach
          </select>
        </div>

        <div class="row mb-3">
          <div class="col-md-8">
            <label for="deskripsi" class="form-label">Deskripsi laporan</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" required></textarea>
          </div>
          <div class="col-md-4">
            <label for="bukti_foto" class="form-label">Foto laporan</label>
            <input type="file" name="bukti_foto" id="bukti_foto" accept="image/*">
          </div>
        </div>

        <div class="mb-3">
          <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian</label>
          <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" required>
        </div>

        <div class="mb-3">
          <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian</label>
          <input type="text" name="lokasi_kejadian" id="lokasi_kejadian" required>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-lapor">LAPOR!</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
