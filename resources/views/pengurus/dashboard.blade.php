<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengurus</title>
    <link href="{{ asset('css/pengurus/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo">
                </div>
                <div class="title-section">
                    <h1 class="title">Selamat Datang, {{ Auth::guard('pengurus')->user()->instansi_pemerintahan }} </h1>
                </div>
            </div>
            <form action="{{ route('pengurus.logout') }}" method="POST" style="margin: 0; position: absolute; top: 20px; right: 30px;">
                @csrf
                <button type="submit" style="all:unset;cursor:pointer;display:flex;align-items:center;gap:8px;">
                <span>Logout</span>
                <span>↗</span>
                </button>
            </form>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <section class="table-section">
                <h2 class="section-title">Data Laporan</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Bukti Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasilPengaduan as $pengaduan)
                        <tr>
                            <td>{{ $pengaduan->id_hasil }}</td>
                            <td>{{ $pengaduan->lokasi_kejadian }}</td>
                            <td>{{ $pengaduan->deskripsi }}</td>
                            <td>{{ $pengaduan->tanggal_kejadian }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$pengaduan->bukti_foto) }}"
                                    alt="Bukti Foto Pengaduan"
                                    class="photo-preview"
                                    onclick="openModal(this.src)">
                            </td>
                            <td>
                                <span class="status-badge status-working">{{ $pengaduan->status }}</span>
                            </td>
                            <td>
                                <div class="action-section">
                                    <form action="{{ route('pengurus.updateStatus', $pengaduan->id_hasil) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <!-- Baris pertama: Dropdown status dan tombol update -->
                                        <div class="form-row">
                                            <select name="status" class="status-dropdown">
                                                <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                <option value="sedang dikerjakan" {{ $pengaduan->status == 'sedang dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                            <button type="submit" class="update-btn">Update</button>
                                        </div>
                                        
                                        <!-- Baris kedua: Textarea keterangan -->
                                        <textarea name="keterangan" 
                                                class="keterangan-textarea"
                                                placeholder="Tambah keterangan...">{{ $pengaduan->keterangan }}</textarea>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('pengurus.hasil.detail', $pengaduan->id_hasil) }}" class="detail-btn">Lihat Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <!-- Modal untuk preview gambar -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script src="{{ asset('js/pengurus/dashboard.js') }}"></script>
</body>
</html>