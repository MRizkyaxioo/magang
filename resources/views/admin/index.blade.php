@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FF8C00 100%);
        min-height: 100vh;
    }

    /* Hide default header/navbar */
.navbar,
.header,
nav,
.top-bar,
.main-header,
header {
    display: none !important;
}

/* Hide any dark header elements */
.bg-dark,
.navbar-dark,
.header-dark {
    display: none !important;
}

    .kategori-container {
        max-width: 1200px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        backdrop-filter: blur(10px);
        margin-top: 20px;
        margin-bottom: 20px;
    }

    /* Header */
    .kategori-header {
        background: linear-gradient(135deg, #B8860B 0%, #DAA520 50%, #FFD700 100%);
        color: #2C1810;
        padding: 30px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .header-text h1 {
        font-size: 32px;
        font-weight: 700;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 5px;
    }

    .header-text p {
        font-size: 16px;
        opacity: 0.8;
        font-weight: 500;
    }

    .add-btn {
        background: rgba(255, 255, 255, 0.9);
        color: #B8860B;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 15px 25px;
        border-radius: 15px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .add-btn:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: #B8860B;
        text-decoration: none;
    }

    /* Alert Messages */
    .alert-container {
        padding: 20px 40px;
    }

    .alert-success {
        background: linear-gradient(135deg, #90EE90 0%, #32CD32 100%);
        color: #006400;
        border: 2px solid #228B22;
        border-radius: 15px;
        padding: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 15px;
        animation: slideInDown 0.5s ease;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Main Content */
    .main-content {
        padding: 40px;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 40px;
        align-items: start;
    }

    /* Kategori Grid */
    .kategori-grid {
        display: grid;
        gap: 20px;
    }

    .kategori-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
        border: 2px solid #FFF8DC;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .kategori-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(255, 193, 7, 0.3);
    }

    .kategori-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #FFD700, #FFA500);
    }

    .kategori-info {
        display: flex;
        align-items: center;
        gap: 20px;
        flex: 1;
    }

    .kategori-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #FFFACD 0%, #FFF8DC 100%);
        border: 2px solid #F0E68C;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .kategori-details h3 {
        font-size: 20px;
        font-weight: 600;
        color: #B8860B;
        margin-bottom: 5px;
    }

    .kategori-details p {
        font-size: 14px;
        color: #8B4513;
        opacity: 0.8;
    }

    .kategori-actions {
        display: flex;
        gap: 10px;
    }

    .action-btn {
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
    }

    .edit-btn {
        background: linear-gradient(135deg, #FFD700, #FFA500);
        color: #2C1810;
        border: 2px solid #B8860B;
    }

    .edit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        background: linear-gradient(135deg, #FFA500, #FF8C00);
        color: #2C1810;
        text-decoration: none;
    }

    .delete-btn {
        background: linear-gradient(135deg, #FF6B6B, #FF4757);
        color: white;
        border: 2px solid #FF3742;
    }

    .delete-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 71, 87, 0.4);
        background: linear-gradient(135deg, #FF4757, #FF3742);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
        border: 2px solid #FFF8DC;
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 600;
        color: #B8860B;
        margin-bottom: 10px;
    }

    .empty-message {
        font-size: 16px;
        color: #8B4513;
        line-height: 1.5;
        margin-bottom: 30px;
    }

    .empty-action {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #2C1810;
        border: 2px solid #B8860B;
        padding: 15px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .empty-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4);
        background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        color: #2C1810;
        text-decoration: none;
    }

    /* Sidebar */
    .sidebar {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
        border: 2px solid #FFF8DC;
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .sidebar-title {
        font-size: 20px;
        font-weight: 600;
        color: #B8860B;
        margin-bottom: 20px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .stats-grid {
        display: grid;
        gap: 15px;
        margin-bottom: 25px;
    }

    .stat-item {
        background: linear-gradient(135deg, #FFFACD 0%, #FFF8DC 100%);
        border: 2px solid #F0E68C;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: #B8860B;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 14px;
        color: #8B4513;
        font-weight: 500;
    }

    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .quick-action-btn {
        width: 100%;
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #2C1810;
        border: 2px solid #B8860B;
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        color: #2C1810;
        text-decoration: none;
    }

    /* FIXED Modal Styles - Ini yang diperbaiki */
    .modal {
        z-index: 1055 !important;
    }

    .modal-backdrop {
        z-index: 1050 !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    .modal-content {
        border-radius: 20px !important;
        border: none !important;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
        position: relative !important;
        z-index: 1056 !important;
    }

    .modal-header {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
        color: #2C1810 !important;
        border-radius: 20px 20px 0 0 !important;
        border-bottom: none !important;
        padding: 25px 30px !important;
    }

    .modal-title {
        font-weight: 700 !important;
        font-size: 20px !important;
    }

    .btn-close {
        background: rgba(44, 24, 16, 0.1) !important;
        border-radius: 50% !important;
        padding: 10px !important;
        opacity: 1 !important;
    }

    .modal-body {
        padding: 30px !important;
        background: white !important;
    }

    .form-label {
        font-weight: 600 !important;
        color: #B8860B !important;
        margin-bottom: 10px !important;
    }

    .form-control {
        border: 2px solid #F0E68C !important;
        border-radius: 10px !important;
        padding: 12px 15px !important;
        font-size: 16px !important;
        transition: all 0.3s ease !important;
    }

    .form-control:focus {
        border-color: #FFD700 !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25) !important;
        outline: none !important;
    }

    .modal .btn {
        padding: 12px 24px !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
        color: #2C1810 !important;
        border: 2px solid #B8860B !important;
    }

    .btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4) !important;
        background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%) !important;
        border-color: #B8860B !important;
        color: #2C1810 !important;
    }

    .btn-secondary {
        background: #6c757d !important;
        border-color: #6c757d !important;
        color: white !important;
    }

    .btn-secondary:hover {
        background: #545b62 !important;
        border-color: #545b62 !important;
        color: white !important;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .main-content {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .sidebar {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .kategori-container {
            margin: 10px;
            border-radius: 15px;
        }

        .kategori-header {
            padding: 20px;
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .header-content {
            flex-direction: column;
            gap: 15px;
        }

        .main-content {
            padding: 20px;
        }

        .kategori-card {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .kategori-actions {
            justify-content: center;
        }
    }

    /* Animation */
    .kategori-card {
        opacity: 0;
        transform: translateY(30px);
        animation: slideInUp 0.6s ease forwards;
    }

    @keyframes slideInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stagger animation for cards */
    .kategori-card:nth-child(1) { animation-delay: 0.1s; }
    .kategori-card:nth-child(2) { animation-delay: 0.2s; }
    .kategori-card:nth-child(3) { animation-delay: 0.3s; }
    .kategori-card:nth-child(4) { animation-delay: 0.4s; }
    .kategori-card:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="kategori-container">
    <!-- Header -->
    <div class="kategori-header">
        <div class="header-content">
            <div class="header-icon">🏷️</div>
            <div class="header-text">
                <h1>Kategori Pengaduan</h1>
                <p>Kelola kategori untuk sistem pengaduan SIMARA</p>
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
                        <p>Kategori pengaduan untuk sistem SIMARA</p>
                    </div>
                </div>
                <div class="kategori-actions">
                    <button type="button" class="action-btn edit-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editKategoriModal{{ $item->id_pengaduan }}">
                        <span>✏️</span>
                        Edit
                    </button>
                    <form action="{{ route('pengaduan.destroy', $item->id_pengaduan) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="action-btn delete-btn" onclick="return confirmDelete('{{ $item->kategori }}')">
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

<script>
    // Pastikan Bootstrap loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Check if Bootstrap is loaded
        if (typeof bootstrap === 'undefined') {
            console.error('Bootstrap JS not loaded!');
            return;
        }

        console.log('Bootstrap loaded successfully');

        // Initialize all modals
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            new bootstrap.Modal(modal);
        });
    });

    // Enhanced delete confirmation
    function confirmDelete(kategoriName) {
        return confirm(`⚠️ Apakah Anda yakin ingin menghapus kategori "${kategoriName}"?\n\nTindakan ini tidak dapat dibatalkan dan akan mempengaruhi pengaduan yang menggunakan kategori ini.`);
    }

    // Export data function
    function exportData() {
        const totalKategori = {{ $pengaduans->count() }};
        if (totalKategori === 0) {
            alert('📂 Tidak ada data kategori untuk diekspor!');
            return;
        }

        alert('🚧 Fitur export data sedang dalam pengembangan.\n\n📊 Data yang akan diekspor:\n• Total ' + totalKategori + ' kategori\n• Format: Excel/CSV\n\nFitur ini akan segera tersedia!');
    }

    // Refresh data function
    function refreshData() {
        const btn = event.target.closest('.quick-action-btn');
        const originalText = btn.innerHTML;

        btn.innerHTML = '<span>⟳</span> Memuat...';
        btn.style.pointerEvents = 'none';

        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    // Auto-hide success alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.animation = 'slideInDown 0.5s ease reverse';
                setTimeout(() => {
                    successAlert.remove();
                }, 500);
            }, 5000);
        }
    });

    // Enhanced form validation
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.classList.contains('delete-btn')) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span>⏳</span> Menyimpan...';
                    submitBtn.disabled = true;

                    // Re-enable button after 3 seconds as fallback
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 3000);
                }
            });
        });
    });

    // Modal event handlers - FIXED
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on modal inputs
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                const input = this.querySelector('input[type="text"]');
                if (input) {
                    setTimeout(() => input.focus(), 100);
                }
            });
        });
    });

    // Real-time input validation
    document.querySelectorAll('input[name="kategori"]').forEach(input => {
        input.addEventListener('input', function() {
            const value = this.value.trim();
            const submitBtn = this.closest('form').querySelector('button[type="submit"]');

            if (value.length < 3) {
                this.style.borderColor = '#FF6B6B';
                submitBtn.disabled = true;
            } else if (value.length > 50) {
                this.style.borderColor = '#FF8C00';
                this.setCustomValidity('Nama kategori maksimal 50 karakter');
            } else {
                this.style.borderColor = '#32CD32';
                this.setCustomValidity('');
                submitBtn.disabled = false;
            }
        });
    });

    // Fix modal backdrop issue
    document.addEventListener('DOMContentLoaded', function() {
        // Remove any existing modal backdrops on page load
        const existingBackdrops = document.querySelectorAll('.modal-backdrop');
        existingBackdrops.forEach(backdrop => backdrop.remove());

        // Reset body classes
        document.body.classList.remove('modal-open');
        document.body.style.paddingRight = '';

        // Handle modal events properly
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function() {
                console.log('Modal showing:', this.id);
            });

            modal.addEventListener('shown.bs.modal', function() {
                console.log('Modal shown:', this.id);
                // Ensure modal is visible
                this.style.display = 'block';
                this.style.zIndex = '1056';
            });

            modal.addEventListener('hidden.bs.modal', function() {
                console.log('Modal hidden:', this.id);
                // Clean up any remaining backdrops
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.paddingRight = '';
            });
        });
    });
</script>
@endsection
