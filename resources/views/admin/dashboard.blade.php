<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - SIPAMA</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
             <div class="logo-section">
                    <div>
                        <img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo">
                    </div>
                    <div class="dashboard-title-section">
                     <h1 class="dashboard-title">Dashboard Admin</h1>
                      <p class="dashboard-subtitle">Sistem Pengaduan Masyarakat (SIPAMA)</p>
                    </div>
                </div>

            <form action="{{ route('admin.logout') }}" method="POST" class="logout-btn" style="margin: 0;">
                @csrf
                <button type="submit">
                    <span>Logout</span>
                    <span>↗</span>
                </button>
            </form>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-number">{{ $hasil->where('status', 'pending')->count() }}</div>
                <div class="stat-label">⏳ Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $hasil->where('status', 'ditolak')->count() }}</div>
                <div class="stat-label">❌ Ditolak</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $hasil->where('status', 'sedang dikerjakan')->count() }}</div>
                <div class="stat-label">🔄 Sedang Dikerjakan</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $hasil->where('status', 'selesai')->count() }}</div>
                <div class="stat-label">✅ Selesai</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $hasil->count() }}</div>
                <div class="stat-label">📊 Total Pengaduan</div>
            </div>
        </div>

        <!-- Main Dashboard -->
        <div class="main-dashboard">
            <!-- Pengaduan Cards -->
            <div class="pengaduan-grid">
                @forelse($hasil as $item)
                <div class="pengaduan-card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <div class="pengadu-info">
                            <h3 class="pengadu-name">👤 {{ $item->pengadu->nama_pengadu ?? 'Pengadu Anonim' }}</h3>
                            <span class="kategori-badge">{{ $item->pengaduan->kategori ?? 'Kategori Umum' }}</span>
                        </div>
                        <form action="{{ route('admin.updateStatus', $item->id_hasil) }}" method="POST" style="margin: 0;">
                            @csrf
                            <select name="status" class="status-dropdown" onchange="this.form.submit()">
                                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                 <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                <option value="sedang dikerjakan" {{ $item->status == 'sedang dikerjakan' ? 'selected' : '' }}>🔄 Sedang Dikerjakan</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                        </form>
                    </div>

                    <!-- Card Content -->
                    <div class="card-content">
                        <div class="content-row">
                            <div class="content-item">
                                <div class="content-label">📍 Lokasi Kejadian</div>
                                <div class="content-value">{{ $item->lokasi_kejadian }}</div>
                            </div>
                            <div class="content-item">
                                <div class="content-label">📅 Tanggal Kejadian</div>
                                <div class="content-value">{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <div class="deskripsi-full">
                            <div class="content-label">📝 Deskripsi Pengaduan</div>
                            <div class="deskripsi-text">{{ $item->deskripsi }}</div>
                        </div>

                        {{-- Keterangan hanya untuk Admin --}}
                        <div class="deskripsi-full" style="margin-top:15px; background:#f9f9f9;">
                            <div class="content-label">📌 Keterangan Admin</div>
                            <form action="{{ route('admin.updateKeterangan', $item->id_hasil) }}" method="POST">
                                @csrf
                                <textarea name="keterangan" rows="3" class="filter-select"
                                          style="width:100%; resize:vertical;">{{ $item->keterangan }}</textarea>
                                <button type="submit" class="detail-btn" style="margin-top:10px;">
                                    💾 Simpan Keterangan
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Foto Section -->
                    <div class="foto-section">
                        @if($item->bukti_foto)
                            <img src="{{ asset('storage/'.$item->bukti_foto) }}"
                                 alt="Bukti Foto Pengaduan"
                                 class="bukti-foto"
                                 onclick="openImageModal('{{ asset('storage/'.$item->bukti_foto) }}')">
                        @else
                            <div class="no-foto">
                                📷 Tidak ada bukti foto
                            </div>
                        @endif
                    </div>

                    <!-- Card Actions -->
                    <div class="card-actions">
                        <a href="{{ route('admin.show', $item->id_hasil) }}" class="detail-btn">
                            <span>👁️</span>
                            Lihat Detail
                        </a>

                        <form action="{{ route('admin.destroy', $item->id_hasil) }}" method="POST" class="delete-form" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="detail-btn delete-btn"
                                style="background:linear-gradient(135deg, #FF6B6B 0%, #FF4757 100%); color:white; border:2px solid #FF3742;">
                                <span>🗑️</span>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3 class="empty-title">Belum Ada Pengaduan</h3>
                    <p class="empty-message">Saat ini belum ada pengaduan yang masuk ke dalam sistem. Data akan muncul setelah ada pengaduan baru dari masyarakat.</p>
                </div>
                @endforelse
            </div>

            <!-- Right Sidebar -->
            <div class="sidebar">
                <h3 class="sidebar-title">🛠️ Panel Kontrol</h3>

                <div class="filter-section">
                    <label class="filter-label">Filter Status:</label>
                    <select class="filter-select" id="statusFilter" onchange="filterByStatus()">
                        <option value="all">Semua Status</option>
                        <option value="pending">⏳ Pending</option>
                        <option value="ditolak">❌ Ditolak</option>
                        <option value="sedang dikerjakan">🔄 Sedang Dikerjakan</option>
                        <option value="selesai">✅ Selesai</option>
                    </select>

                    <label class="filter-label">Filter Kategori:</label>
                    <select class="filter-select" id="kategoriFilter" onchange="filterByKategori()">
                        <option value="all">Semua Kategori</option>
                        @foreach($hasil->unique('pengaduan.kategori') as $item)
                            @if($item->pengaduan && $item->pengaduan->kategori)
                            <option value="{{ $item->pengaduan->kategori }}">{{ $item->pengaduan->kategori }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('pengaduan.index') }}" class="action-btn">
                        <span>🏢</span>
                        Kelola Kategori Pengaduan
                    </a>

                    <a href="{{ route('pengurus.create') }}" class="action-btn">
                        <span>🏢</span>
                        Buat Akun Pengurus
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:1000; cursor:pointer;" onclick="closeImageModal()">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); max-width:90%; max-height:90%;">
            <img id="modalImage" style="max-width:100%; max-height:100%; border-radius:10px; box-shadow:0 20px 60px rgba(0,0,0,0.5);">
        </div>
    </div>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script>
        // Notifikasi sukses setelah hapus
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
