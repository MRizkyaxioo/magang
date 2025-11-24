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
    <!-- Password Modal - Perbaikan struktur -->
    <div id="passwordModal" class="modal" style="{{ $errors->any() ? 'display:block;' : '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h2>🔐 Ubah Password Admin</h2>
                <span class="close-btn" onclick="closePasswordModal()">&times;</span>
            </div>
            <form method="POST" action="{{ route('admin.change-password') }}">
                @csrf

                <!-- Password Lama -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Password Lama</label>
                    <div class="password-field">
                        <input type="password"
                               name="current_password"
                               id="current_password"
                               value="{{ old('current_password') }}"
                               required>
                        <span class="toggle-password" onclick="togglePassword('current_password', this)">👁️</span>
                    </div>
                    @error('current_password')
                        <small style="display: block; color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Password Baru</label>
                    <div class="password-field">
                        <input type="password"
                               name="new_password"
                               id="new_password"
                               required
                               minlength="6">
                        <span class="toggle-password" onclick="togglePassword('new_password', this)">👁️</span>
                    </div>
                    @error('new_password')
                        <small style="display: block; color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Konfirmasi Password Baru</label>
                    <div class="password-field">
                        <input type="password"
                               name="new_password_confirmation"
                               id="new_password_confirmation"
                               required>
                        <span class="toggle-password" onclick="togglePassword('new_password_confirmation', this)">👁️</span>
                    </div>
                    @error('new_password_confirmation')
                        <small style="display: block; color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit">Ubah Password</button>
            </form>
        </div>
    </div>

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

            <div class="profile-container">
                <div class="profile-icon" id="profileIcon">👤</div>
                <div class="profile-dropdown" id="profileDropdown">
                    <button type="button" class="action-btn" onclick="openPasswordModal()">
                        <span>🔐</span> Ganti Password
                    </button>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">🚪 Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-number">{{ $allHasil->where('status', 'pending')->count() }}</div>
                <div class="stat-label">⏳ Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $allHasil->where('status', 'ditolak')->count() }}</div>
                <div class="stat-label">❌ Ditolak</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $allHasil->where('status', 'sedang dikerjakan')->count() }}</div>
                <div class="stat-label">🔄 Sedang Dikerjakan</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $allHasil->where('status', 'selesai')->count() }}</div>
                <div class="stat-label">✅ Selesai</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $allHasil->count() }}</div>
                <div class="stat-label">📊 Total Pengaduan</div>
            </div>
        </div>

        <!-- Main Dashboard -->
        <div class="main-dashboard">
            <!-- KOLOM KIRI: Pengaduan Cards -->
            <div class="pengaduan-grid">
                @forelse($hasil as $item)
                <div class="pengaduan-card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <div class="pengadu-info">
                            <h3 class="pengadu-name">👤 {{ $item->pengadu->nama_pengadu ?? 'Pengadu Anonim' }}</h3>
                            <span class="kategori-badge">{{ $item->pengaduan->kategori ?? 'Kategori Umum' }}</span>
                            <small class="kategori-badge">Pengurus: {{ $item->pengaduan->pengurus->pluck('instansi_pemerintahan')->join(', ') ?? 'Belum ada instansi' }}</small>
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

                        <div class="deskripsi-full" style="margin-top:15px; background:#f9f9f9;">
                            <div class="content-label">📌 Keterangan Admin</div>
                            <form action="{{ route('admin.updateKeterangan', $item->id_hasil) }}" method="POST">
                                @csrf
                                <textarea name="keterangan" rows="3" class="filter-select" style="width:100%; resize:vertical;">{{ $item->keterangan }}</textarea>
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
                    <p class="empty-message">Saat ini belum ada pengaduan yang masuk ke dalam sistem.</p>
                </div>
                @endforelse

                <!-- Pagination -->
                @if($hasil->hasPages())
                <div class="pagination-wrapper">
                    {{ $hasil->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>

            <!-- KOLOM KANAN: Sidebar (Sticky) -->
            <div class="sidebar">
                <h3 class="sidebar-title">🛠️ Panel Kontrol</h3>

                <div class="filter-section">
                    <label class="filter-label">Filter Status:</label>
                    <select class="filter-select" id="statusFilter" onchange="applyFilters()">
                        <option value="all">Semua Status</option>
                        <option value="pending">⏳ Pending</option>
                        <option value="ditolak">❌ Ditolak</option>
                        <option value="sedang dikerjakan">🔄 Sedang Dikerjakan</option>
                        <option value="selesai">✅ Selesai</option>
                    </select>

                    <label class="filter-label">Filter Kategori:</label>
                    <select class="filter-select" id="kategoriFilter" onchange="applyFilters()">
                        <option value="all">Semua Kategori</option>
                        @foreach($allHasil->unique('pengaduan.kategori')->sortBy('pengaduan.kategori') as $item)
                            @if($item->pengaduan && $item->pengaduan->kategori)
                            <option value="{{ $item->pengaduan->kategori }}">{{ $item->pengaduan->kategori }}</option>
                            @endif
                        @endforeach
                    </select>

                    <label class="filter-label">Filter Pengurus:</label>
                    <select class="filter-select" id="pengurusFilter" onchange="applyFilters()">
                        <option value="all">Semua Pengurus</option>
                        @foreach($allHasil->pluck('pengaduan.pengurus')->flatten()->unique('instansi_pemerintahan')->sortBy('instansi_pemerintahan') as $pengurus)
                            @if($pengurus && $pengurus->instansi_pemerintahan)
                                <option value="{{ $pengurus->instansi_pemerintahan }}">
                                    {{ $pengurus->instansi_pemerintahan }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('pengaduan.index') }}" class="action-btn">
                        <span>📋</span>
                        Kelola Kategori Pengaduan
                    </a>

                    <a href="{{ route('pengurus.create') }}" class="action-btn">
                        <span>👥</span>
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

    <script>
        // SweetAlert untuk success message
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
            window.addEventListener('DOMContentLoaded', function() {
                document.getElementById('passwordModal').style.display = 'block';
            });
        @endif
    </script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
</body>
</html>
