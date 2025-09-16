<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Hasil Pengaduan - SIPAMA</title>
    <link href="{{ asset('css/pengurus/show.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="main-title">Detail Hasil Pengaduan</h1>

        <!-- Informasi Pengaduan Card -->
        <div class="info-card fade-in">
            <h2 class="card-title">Informasi Pengaduan</h2>

            <div class="info-item">
                <span class="info-label">Kategori:</span>
                <span class="info-value">{{ $hasilPengaduan->pengaduan->kategori ?? '-' }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Lokasi Kejadian:</span>
                <span class="info-value">{{ $hasilPengaduan->lokasi_kejadian }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Tanggal Kejadian:</span>
                <span class="info-value">{{ $hasilPengaduan->tanggal_kejadian }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Deskripsi:</span>
                <span class="info-value">{{ $hasilPengaduan->deskripsi }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Status:</span>
                <span class="info-value">
                    <span class="status-badge">{{ ucfirst($hasilPengaduan->status) }}</span>
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Keterangan:</span>
                <span class="info-value">{{ $hasilPengaduan->keterangan }}</span>
            </div>

@if($hasilPengaduan->bukti_foto)
            <div class="info-item">
                <span class="info-label">Bukti foto:</span>
                <div class="photo-container">
                    <img src="{{ asset('storage/'.$hasilPengaduan->bukti_foto) }}"
                     alt="Bukti Foto"
                         class="evidence-photo"
                         onclick="openModal(this.src)">
@endif
                </div>
            </div>
        </div>

        <!-- Detail Pengadu Card -->
        <div class="info-card fade-in">
            <h2 class="card-title">Detail Pengadu</h2>

            <div class="info-item">
                <span class="info-label">NIK:</span>
                <span class="info-value">{{ $hasilPengaduan->pengadu->nik ?? '-' }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Nama:</span>
                <span class="info-value">{{ $hasilPengaduan->pengadu->nama_pengadu ?? '-' }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Alamat:</span>
                <span class="info-value">{{ $hasilPengaduan->pengadu->alamat ?? '-' }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Tempat Lahir:</span>
                <span class="info-value">{{ $hasilPengaduan->pengadu->tempat_lahir ?? '-' }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Tanggal Lahir:</span>
                <span class="info-value">{{ $hasilPengaduan->pengadu->tanggal_lahir ?? '-' }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">No. Telepon:</span>
                <span class="info-value">{{ $hasilPengaduan->pengadu->no_telp ?? '-' }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $hasilPengaduan->pengadu->email ?? '-' }}</span>
            </div>
        </div>

        <!-- Back Button -->
        <a href='{{ route('pengurus.dashboard') }}' class="back-button">
            <span class="back-arrow">←</span>
            Kembali ke halaman utama
        </a>
    </div>

    <!-- Modal for Image Preview -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script src="{{ asset('js/pengurus/show.js') }}"></script>
</body>
</html>