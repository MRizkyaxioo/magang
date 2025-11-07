<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pengaduan - SIPAMA</title>
  <link rel="stylesheet" href="{{ asset('css/pengadu/riwayat.css') }}">
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
              <th>Koordinat</th>
              <th>Tanggal Kejadian</th>
              <th>Status</th>
              <th>Keterangan</th>
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
              <td>{{ $item->latitude }} {{ $item->longitude }}</td>
              <td>{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d M Y') }}</td>
              <td>
                <span class="status {{ str_replace(' ', '-', strtolower($item->status)) }}">
                  {{ ucfirst($item->status) }}
                </span>
              </td>
              <td>{{ $item->keterangan }}</td>
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
        <!-- Pagination -->
@if($riwayat->hasPages())
<div class="pagination-wrapper">
  {{ $riwayat->links('pagination::bootstrap-5') }}
</div>
@endif
        @endif

        <div class="btn-container">
          <a href="{{ route('pengadu.dashboard') }}" class="back-btn">⬅ Kembali ke Dashboard</a>
        </div>
      </section>
    </main>
  </div>

  <script src="{{ asset('js/pengadu/riwayat.js') }}"></script>
</body>
</html>
