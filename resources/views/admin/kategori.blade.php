<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kategori Pengaduan - SIPAMA</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/kategori.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="kategori-container">
        <!-- Header -->
        <div class="kategori-header">
            <div class="header-content">
                <div class="header-icon">🏷️</div>
                <div class="header-text">
                    <h1>Kategori Pengaduan</h1>
                    <p>Kelola kategori untuk sistem pengaduan SIPAMA</p>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="window.location.href='{{ route('admin.dashboard') }}'">
                <span>🏠</span>
                Kembali ke halaman utama
            </button>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert-container">
            <div class="alert-success">
                <span>✅</span>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <div class="main-content">
            <!-- Kategori Grid -->
            <div class="kategori-grid">
                @forelse($pengaduans as $index => $item)
                <div class="kategori-card">
                    <div class="kategori-info">
                        <div class="kategori-icon">
                            {{ $index % 2 == 0 ? '📋' : '🔧' }}
                        </div>
                        <div class="kategori-details">
                            <h3>{{ $item->kategori }}</h3>
                            <p>Kategori pengaduan untuk sistem SIPAMA</p>
                        </div>
                    </div>
                    <div class="kategori-actions">
                        <button type="button" class="action-btn edit-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editKategoriModal{{ $item->id_pengaduan }}">
                            <span>✏️</span>
                            Edit
                        </button>
                        <form action="{{ route('pengaduan.destroy', $item->id_pengaduan) }}" method="POST" class="delete-form" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="action-btn delete-btn" type="submit" class="action-btn delete-btn">
                                <span>🗑️</span>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon">📂</div>
                    <h3 class="empty-title">Belum Ada Kategori</h3>
                    <p class="empty-message">
                        Saat ini belum ada kategori pengaduan yang tersedia.
                        Tambahkan kategori pertama untuk memulai mengelola pengaduan masyarakat.
                    </p>
                    <button type="button" class="empty-action" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                        <span>➕</span>
                        Tambah Kategori Pertama
                    </button>
                </div>
                @endforelse
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <h3 class="sidebar-title">
                    <span>📊</span>
                    Statistik
                </h3>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">{{ $pengaduans->count() }}</div>
                        <div class="stat-label">Total Kategori</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $pengaduans->count() > 0 ? '✅' : '⏳' }}</div>
                        <div class="stat-label">{{ $pengaduans->count() > 0 ? 'Aktif' : 'Kosong' }}</div>
                    </div>
                </div>

                <div class="quick-actions">
                    <button type="button" class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                        <span>➕</span>
                        Tambah Kategori
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit - Dipindah ke luar loop -->
    @forelse($pengaduans as $item)
    <div class="modal fade" id="editKategoriModal{{ $item->id_pengaduan }}" tabindex="-1" aria-labelledby="editKategoriLabel{{ $item->id_pengaduan }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel{{ $item->id_pengaduan }}">
                        <span>✏️</span> Edit Kategori
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengaduan.update', $item->id_pengaduan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kategori{{ $item->id_pengaduan }}" class="form-label">Nama Kategori</label>
                            <input type="text"
                                   name="kategori"
                                   id="kategori{{ $item->id_pengaduan }}"
                                   class="form-control"
                                   value="{{ $item->kategori }}"
                                   required
                                   placeholder="Masukkan nama kategori...">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <span>💾</span> Update Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse

    <!-- Modal Tambah -->
    <div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kategoriModalLabel">
                        <span>➕</span> Tambah Kategori Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengaduan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Nama Kategori</label>
                            <input type="text"
                                   name="kategori"
                                   id="kategori"
                                   class="form-control"
                                   required
                                   placeholder="Contoh: Jalan Rusak, Sampah Berhamburan, dll..."
                                   autocomplete="off">
                            <small class="form-text text-muted">
                                Masukkan nama kategori yang akan digunakan untuk klasifikasi pengaduan
                            </small>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <span>💾</span> Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/admin/kategori.js') }}"></script>
     <script>
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
