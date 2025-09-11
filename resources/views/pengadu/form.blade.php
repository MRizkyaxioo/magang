<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
   body {
      /* Background yang sama dengan dashboard - gradasi emas */
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FF8C00 100%);
      min-height: 100vh;
      position: relative;
      padding: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .logo {
     width: 200px;
     height: 150px;
     align-items: center;
     justify-content: center;
     position: absolute;
    }

    .form-container {
      max-width: 700px;
      margin: 30px auto 0; /* Dikurangi dari 120px ke 30px */
      border: 2px solid #B8860B;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.95);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      backdrop-filter: blur(10px);
    }

    .form-header {
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
      color: #2C1810;
      padding: 20px;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin: 0;
      border-radius: 0;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .btn-lapor {
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
      color: #2C1810;
      border: 2px solid #B8860B;
      font-weight: bold;
      padding: 15px 30px;
      border-radius: 12px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
    }

    /* Styling untuk tombol yang sejajar */
    .btn-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 30px;
    }

    .back-btn {
      padding: 15px 30px;
      background: white;
      border: 2px solid #B8860B;
      border-radius: 12px;
      text-decoration: none;
      color: #B8860B;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(184, 134, 11, 0.4);
      font-size: 16px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .back-btn:hover {
      background: #FFFACD;
      box-shadow: 0 12px 35px rgba(255, 193, 7, 0.6);
      transform: translateY(-3px);
      color: #8B4513;
    }

    .btn-lapor:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(255, 193, 7, 0.6);
      background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
      color: #2C1810;
    }

    .btn-lapor:active, .back-btn:active {
      transform: translateY(-1px);
    }

    select, textarea, input[type="text"], input[type="date"], input[type="file"] {
      width: 100%;
      border: 2px solid #F0E68C;
      padding: 12px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.9);
      color: #2C1810;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    select:focus, textarea:focus, input[type="text"]:focus,
    input[type="date"]:focus, input[type="file"]:focus {
      border-color: #FFD700;
      box-shadow: 0 5px 20px rgba(255, 193, 7, 0.3);
      background: #FFFACD;
      outline: none;
    }

    .form-label {
      color: #8B4513;
      font-weight: 600;
      margin-bottom: 8px;
      display: block;
    }

    .header {
      text-align: center;
      margin-bottom: 20px; /* Dikurangi dari 30px ke 20px */
      background: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 15px;
      border: 2px solid #B8860B;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      margin-top: 25px;
      margin-bottom: auto;
    }

    .header h3 {
      color: #B8860B;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 10px;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .header p {
      color: #8B4513;
      font-size: 16px;
      margin: 0;
    }

    .form-content {
      padding: 30px;
      background: white;
      border-radius: 0 0 18px 18px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .logo {
        position: static;
        display: block;
        margin: 20px auto;
        width: 150px;
        height: 120px;
      }

      .header {
        margin-top: 20px;
      }

      .form-container {
        margin-top: 20px;
        margin-left: 10px;
        margin-right: 10px;
      }

      /* Stack tombol pada mobile */
      .btn-container {
        flex-direction: column;
        gap: 15px;
      }

      .btn-lapor, .back-btn {
        width: 100%;
        text-align: center;
        justify-content: center;
      }
    }

    /* Hover effect for form container */
    .form-container:hover {
      transform: translateY(-2px);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    /* File input styling */
    input[type="file"] {
      padding: 8px;
      cursor: pointer;
    }

    input[type="file"]::-webkit-file-upload-button {
      background: linear-gradient(135deg, #FFD700, #FFA500);
      border: 1px solid #B8860B;
      border-radius: 6px;
      padding: 8px 12px;
      margin-right: 10px;
      color: #2C1810;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
      background: linear-gradient(135deg, #FFA500, #FF8C00);
    }
  </style>
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
            <label for="bukti_foto" class="form-label">Foto laporan</label>
            <input type="file" name="bukti_foto" id="bukti_foto" accept="image/*">
            <small class="text-muted">Format: JPG, PNG, GIF (Maks. 5MB)</small>
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

<script>
// Add smooth animations on page load
window.addEventListener('load', function() {
    const elements = document.querySelectorAll('.header, .form-container');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';

        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0);
        }, index * 200);
    });
});

// Form validation feedback
document.querySelector('form').addEventListener('submit', function(e) {
    const button = document.querySelector('.btn-lapor');
    button.innerHTML = '⏳ Mengirim...';
    button.disabled = true;
});

</script>

</body>
</html>
