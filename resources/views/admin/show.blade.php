<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <link href="{{ asset('css/admin/show.css') }}" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">


        <!-- Main Content -->
        <div class="main-content">
            <!-- Detail Pengaduan -->
            <div class="detail-section">
                <h2 class="section-title">Detail Hasil Pengaduan</h2>

                <!-- Informasi Pengaduan -->
                <div class="info-section">
                    <h3 style="color: #B8860B; margin-bottom: 15px; font-size: 16px;">Informasi Pengaduan</h3>

                    <div class="info-row">
    <span class="info-label">Kategori:</span>
    <span class="info-value">
        <form action="{{ route('admin.updateKategori', $hasil->id_hasil) }}" method="POST">
            @csrf
            <select name="id_pengaduan" class="filter-select" onchange="this.form.submit()">
                @foreach(\App\Models\Pengaduan::all() as $kategori)
                    <option value="{{ $kategori->id_pengaduan }}"
                        {{ $hasil->id_pengaduan == $kategori->id_pengaduan ? 'selected' : '' }}>
                        {{ $kategori->kategori }}
                    </option>
                @endforeach
            </select>
        </form>
    </span>
</div>


                    <div class="info-row">
                        <span class="info-label">Lokasi Kejadian:</span>
                        <span class="info-value">{{ $hasil->lokasi_kejadian }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Tanggal Kejadian:</span>
                        <span class="info-value">{{ $hasil->tanggal_kejadian }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Deskripsi:</span>
                        <span class="info-value">{{ $hasil->deskripsi }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Status:</span>
                        <span class="info-value">
                            <span class="status-badge">{{ $hasil->status }}</span>
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Keterangan:</span>
                        <span class="info-value">{{ $hasil->keterangan }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Bukti foto:</span>
                        <div class="info-value">
                            <img src="{{ asset('storage/'.$hasil->bukti_foto) }}"
                                 alt="Bukti Foto Pengaduan"
                                 class="bukti-foto"
                                 onclick="openModal(this.src)">
                        </div>
                    </div>
                </div>

                <!-- Detail Pengadu -->
                <div class="pengadu-section">
                    <h3 style="color: #4682B4; margin-bottom: 15px; font-size: 16px;">Detail Pengadu</h3>

                    <div class="info-row">
                        <span class="info-label">NIK:</span>
                        <span class="info-value">{{ $hasil->pengadu->nik ?? '-' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Nama:</span>
                        <span class="info-value">{{ $hasil->pengadu->nama_pengadu ?? '-' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Alamat:</span>
                        <span class="info-value"> {{ $hasil->pengadu->alamat ?? '-' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Tempat Lahir:</span>
                        <span class="info-value">{{ $hasil->pengadu->tempat_lahir ?? '-' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Tanggal Lahir:</span>
                        <span class="info-value"> {{ $hasil->pengadu->tanggal_lahir ?? '-' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">No. Telepon:</span>
                        <span class="info-value">{{ $hasil->pengadu->no_telp ?? '-' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value"> {{ $hasil->pengadu->email ?? '-' }}</span>
                    </div>
                </div>

                <a class="back-btn" onclick="window.location.href='{{ route('admin.dashboard') }}'">
                    <span>←</span>
                    Kembali ke halaman utama
                </a>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <div class="modal-content">
            <img id="modalImage" alt="Bukti Foto">
        </div>
    </div>

    <script src="{{ asset('js/admin/show.js') }}"></script>
</body>
</html>