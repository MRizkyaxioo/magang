<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pengaduan - SIMARA</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FF8C00 100%);
      min-height: 100vh;
      padding: 20px;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      backdrop-filter: blur(10px);
      animation: fadeIn 0.8s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .header {
      background: linear-gradient(135deg, #B8860B 0%, #DAA520 50%, #FFD700 100%);
      color: #2C1810;
      padding: 20px 30px;
      display: grid;
      grid-template-columns: 1fr auto 1fr; /* kiri - tengah - kanan */
      align-items: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .logo-section { display: flex; align-items: center; gap: 20px; }
    .logo {
   width: 200px;
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain; /* supaya gambar tidak ketarik */
}
    .title-section {
      background: rgba(255, 255, 255, 0.9);
      padding: 15px 40px;
      border-radius: 10px;
      border: 2px solid #B8860B;
      text-align: center;
      justify-self: center; /* pastikan di tengah grid */
    }
    .title { font-size: 26px; font-weight: 700; color: #B8860B; }
    .logout-btn {
      background: rgba(255, 255, 255, 0.2);
      padding: 12px 20px; border-radius: 25px;
      cursor: pointer; transition: 0.3s;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      display: flex; align-items: center; gap: 8px;
      color: #2C1810; font-weight: 500;
    }
    .logout-btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    .main-content { padding: 40px 30px; }
    .riwayat-section {
      background: white; border-radius: 20px;
      padding: 30px; box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
      border: 2px solid #FFF8DC;
    }
    .section-title { font-size: 28px; font-weight: 700; color: #B8860B; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 30px; border-radius: 15px; overflow: hidden; }
    table th, table td {
      padding: 15px; text-align: left;
      border: 1px solid #F0E68C; font-size: 15px; color: #333;
    }
    table th { background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); color: #2C1810; }
    .status { display: inline-block; padding: 6px 12px; border-radius: 20px; font-weight: bold; font-size: 14px; color: white; }
    .status.pending {
  background: #FFC107; /* kuning */
  color: #2C1810;
}

.status.sedang-dikerjakan {
  background: #17A2B8; /* biru */
  color: white;
}

.status.selesai {
  background: #28A745; /* hijau */
  color: white;
}

    .btn-container { display: flex; justify-content: space-between; }
    .back-btn {
      padding: 12px 20px; background: white;
      border: 2px solid #B8860B; border-radius: 12px;
      text-decoration: none; color: #B8860B; font-weight: 600;
      transition: 0.3s;
    }
    .back-btn:hover {
      background: #FFFACD; box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
      transform: translateY(-2px);
    }

    .logout-container {
  display: flex;
  justify-content: flex-end; /* dorong logout ke kanan */
}
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <header class="header">
  <div class="logo-section">
    <div class="logo">
      <img src="{{ asset('images/logo_pemko.png') }}" alt="Logo Pemko">
    </div>
  </div>

  <div class="title-section">
    <h1 class="title">Selamat Datang {{ Auth::guard('pengadu')->user()->nama_pengadu }}</h1>
  </div>

  <div class="logout-container">
    <form action="{{ route('pengadu.logout') }}" method="POST">
      @csrf
      <button type="submit" class="logout-btn">↗ Logout</button>
    </form>
  </div>
</header>



    <!-- Main Content -->
    <main class="main-content">
      <section class="riwayat-section">
        <h2 class="section-title">Riwayat Pengaduan</h2>

        @if($riwayat->isEmpty())
          <p>Belum ada riwayat pengaduan.</p>
        @else
        <table>
          <thead>
            <tr>
              <th>No.</th>
              <th>Kategori</th>
              <th>Deskripsi</th>
              <th>Lokasi</th>
              <th>Tanggal Kejadian</th>
              <th>Status</th>
              <th>Foto Pendukung</th>
            </tr>
          </thead>
          <tbody>
            @foreach($riwayat as $key => $item)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $item->pengaduan->kategori ?? '-' }}</td>
              <td>{{ $item->deskripsi }}</td>
              <td>{{ $item->lokasi_kejadian }}</td>
              <td>{{ $item->tanggal_kejadian }}</td>
              <td>
  <span class="status {{ str_replace(' ', '-', strtolower($item->status)) }}">
    {{ ucfirst($item->status) }}
  </span>
</td>

              <td>
                @if($item->bukti_foto)
                  <img src="{{ asset('storage/'.$item->bukti_foto) }}" alt="Bukti Foto" width="120">
                @else
                  <span class="text-muted">Tidak ada foto</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif

        <div class="btn-container">
          <a href="{{ route('pengadu.dashboard') }}" class="back-btn">⬅ Kembali ke Dashboard</a>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
