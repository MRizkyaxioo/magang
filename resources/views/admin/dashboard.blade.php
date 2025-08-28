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

    .dashboard-container {
        max-width: 1400px;
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
    .dashboard-header {
        background: linear-gradient(135deg, #B8860B 0%, #DAA520 50%, #FFD700 100%);
        color: #2C1810;
        padding: 25px 40px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .dashboard-title {
        font-size: 36px;
        font-weight: 700;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
    }

    .dashboard-subtitle {
        font-size: 16px;
        opacity: 0.8;
        font-weight: 500;
    }

    /* Stats Cards */
    .stats-section {
        padding: 30px 40px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.2);
        border: 2px solid #FFF8DC;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.3);
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #B8860B;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 16px;
        color: #8B4513;
        font-weight: 500;
    }

    /* Main Content Layout */
    .main-dashboard {
        padding: 0 40px 40px 40px;
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 30px;
        align-items: start;
    }

    /* Pengaduan Cards */
    .pengaduan-grid {
        display: grid;
        gap: 25px;
    }

    .pengaduan-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
        border: 2px solid #FFF8DC;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .pengaduan-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(255, 193, 7, 0.3);
    }

    .pengaduan-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #FFD700, #FFA500);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .pengadu-info {
        flex: 1;
    }

    .pengadu-name {
        font-size: 20px;
        font-weight: 700;
        color: #B8860B;
        margin-bottom: 5px;
    }

    .kategori-badge {
        display: inline-block;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        color: #2C1810;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .status-dropdown {
        background: white;
        border: 2px solid #F0E68C;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 14px;
        color: #8B4513;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 140px;
    }

    .status-dropdown:hover {
        border-color: #FFD700;
        box-shadow: 0 3px 15px rgba(255, 193, 7, 0.3);
    }

    .status-dropdown option {
        background: white;
        color: #8B4513;
        padding: 10px;
    }

    .card-content {
        margin-bottom: 20px;
    }

    .content-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 15px;
    }

    .content-item {
        background: #FFFACD;
        border: 1px solid #F0E68C;
        border-radius: 10px;
        padding: 15px;
    }

    .content-label {
        font-size: 12px;
        color: #B8860B;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .content-value {
        font-size: 14px;
        color: #8B4513;
        font-weight: 500;
        line-height: 1.4;
    }

    .deskripsi-full {
        grid-column: 1 / -1;
        background: #FFF8DC;
        border: 1px solid #F0E68C;
        border-radius: 12px;
        padding: 20px;
        margin-top: 15px;
    }

    .deskripsi-text {
        color: #8B4513;
        line-height: 1.6;
        font-size: 15px;
    }

    .foto-section {
        margin: 20px 0;
        text-align: center;
    }

    .bukti-foto {
        max-width: 200px;
        max-height: 150px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .bukti-foto:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
    }

    .no-foto {
        background: #F5F5DC;
        border: 2px dashed #D2B48C;
        border-radius: 12px;
        padding: 30px;
        color: #8B4513;
        font-style: italic;
    }

    .card-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #F0E68C;
    }

    .detail-btn {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #2C1810;
        border: 2px solid #B8860B;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        color: #2C1810;
        text-decoration: none;
    }

    /* Right Sidebar */
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
        font-size: 22px;
        font-weight: 600;
        color: #B8860B;
        margin-bottom: 20px;
        text-align: center;
    }

    .filter-section {
        margin-bottom: 25px;
    }

    .filter-label {
        font-size: 14px;
        color: #8B4513;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .filter-select {
        width: 100%;
        background: white;
        border: 2px solid #F0E68C;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 14px;
        color: #8B4513;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 15px;
    }

    .filter-select:hover, .filter-select:focus {
        border-color: #FFD700;
        outline: none;
        box-shadow: 0 3px 15px rgba(255, 193, 7, 0.3);
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .action-btn {
        width: 100%;
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #2C1810;
        border: 2px solid #B8860B;
        padding: 15px 20px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4);
        background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        color: #2C1810;
        text-decoration: none;
    }

    /* Logout Button - Special styling */
    .logout-btn {
        width: 100%;
        background: linear-gradient(135deg, #FF6B6B 0%, #FF4757 100%);
        color: white;
        border: 2px solid #FF3742;
        padding: 15px 20px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 71, 87, 0.4);
        background: linear-gradient(135deg, #FF4757 0%, #FF3742 100%);
        color: white;
        text-decoration: none;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
        border: 2px solid #FFF8DC;
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
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
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .main-dashboard {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .sidebar {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            margin: 10px;
            border-radius: 15px;
        }

        .dashboard-header {
            padding: 20px;
        }

        .dashboard-title {
            font-size: 28px;
        }

        .stats-section, .main-dashboard {
            padding: 20px;
        }

        .content-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .card-actions {
            flex-direction: column;
        }
    }

    /* Animation */
    .pengaduan-card {
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
    .pengaduan-card:nth-child(1) { animation-delay: 0.1s; }
    .pengaduan-card:nth-child(2) { animation-delay: 0.2s; }
    .pengaduan-card:nth-child(3) { animation-delay: 0.3s; }
    .pengaduan-card:nth-child(4) { animation-delay: 0.4s; }
    .pengaduan-card:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="dashboard-container">
    <!-- Header -->
<div class="dashboard-header" style="position: relative;">
    <h1 class="dashboard-title">📋 Dashboard Admin</h1>
    <p class="dashboard-subtitle">Sistem Informasi Masyarakat (SIMARA)</p>

    <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0; position: absolute; top: 20px; right: 30px;">
        @csrf
        <button type="submit" class="logout-btn" style="width:auto; padding:10px 20px; border-radius:8px;">
            <span>🚪</span>
            Logout
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

                <!-- Logout Button - Moved here -->
                {{-- <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn" >
                        <span>🚪</span>
                        Logout
                    </button>
                </form> --}}
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
    // Image Modal Functions
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').style.display = 'block';
    }

    function closeImageModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    // Filter Functions
    function filterByStatus() {
        const selectedStatus = document.getElementById('statusFilter').value;
        const cards = document.querySelectorAll('.pengaduan-card');

        cards.forEach(card => {
            if (selectedStatus === 'all') {
                card.style.display = 'block';
            } else {
                const statusSelect = card.querySelector('select[name="status"]');
                const cardStatus = statusSelect ? statusSelect.value : '';
                card.style.display = cardStatus === selectedStatus ? 'block' : 'none';
            }
        });

        updateEmptyState();
    }

    function filterByKategori() {
        const selectedKategori = document.getElementById('kategoriFilter').value;
        const cards = document.querySelectorAll('.pengaduan-card');

        cards.forEach(card => {
            if (selectedKategori === 'all') {
                card.style.display = 'block';
            } else {
                const kategoriBadge = card.querySelector('.kategori-badge');
                const cardKategori = kategoriBadge ? kategoriBadge.textContent.trim() : '';
                card.style.display = cardKategori === selectedKategori ? 'block' : 'none';
            }
        });

        updateEmptyState();
    }

    function updateEmptyState() {
        const visibleCards = Array.from(document.querySelectorAll('.pengaduan-card')).filter(card =>
            card.style.display !== 'none'
        );
        const emptyState = document.querySelector('.empty-state');

        if (visibleCards.length === 0 && !emptyState) {
            const grid = document.querySelector('.pengaduan-grid');
            grid.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">🔍</div>
                    <h3 class="empty-title">Tidak Ada Data</h3>
                    <p class="empty-message">Tidak ditemukan pengaduan sesuai dengan filter yang dipilih.</p>
                </div>
            `;
        }
    }

    // Action Functions
    function exportData() {
        alert('🚧 Fitur export data sedang dalam pengembangan. Akan segera tersedia!');
    }

    function refreshData() {
        const btn = event.target.closest('.action-btn');
        const originalText = btn.innerHTML;

        btn.innerHTML = '<span>⟳</span> Memuat...';
        btn.style.pointerEvents = 'none';

        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    function printReport() {
        if (confirm('Apakah Anda ingin mencetak laporan pengaduan?')) {
            window.print();
        }
    }

    // Auto-refresh stats setiap 30 detik
    setInterval(() => {
        // Update stats numbers dengan animasi
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            stat.style.transform = 'scale(1.1)';
            setTimeout(() => {
                stat.style.transform = 'scale(1)';
            }, 200);
        });
    }, 30000);

    // Smooth scroll untuk navigasi
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endsection
