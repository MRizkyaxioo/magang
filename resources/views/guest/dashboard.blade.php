<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAMA - Dashboard</title>

    {{-- Link CSS --}}
    <link rel="stylesheet" href="{{ asset('css/guest/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo-section">
                <div>
                    <img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo">
                </div>
                <div class="title-section">
                    <h1 class="dashboard-title"> Dashboard Utama</h1>
                    <p class="dashboard-subtitle">Sistem Pengaduan Masyarakat (SIPAMA)</p>
                </div>
            </div>
            <a href="{{ route('pengadu.login') }}" class="login-btn">
                <span>🚪</span>
                Login
            </a>
        </header>

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

        <!-- Main Content -->
        <main class="main-content">
            <div class="left-content">
                <!-- SIMARA Section -->
                <section class="simara-section">
                    <h2 class="section-title">SIPAMA</h2>
                    <div class="info-box">
                        <p class="info-text">
                            Sistem Pengaduan Masyarakat (SIPAMA) adalah platform digital yang memudahkan warga Banjarmasin menyampaikan aspirasi, keluhan, dan saran terkait pelayanan publik secara cepat, mudah, dan transparan tanpa perlu datang langsung ke kantor pemerintahan.
SIPAMA hadir untuk meningkatkan kualitas layanan publik, mempercepat tindak lanjut laporan, dan membangun komunikasi dua arah antara masyarakat dan pemerintah.
Data dari pengaduan juga digunakan sebagai bahan evaluasi untuk meningkatkan kinerja dan kebijakan publik agar lebih tepat sasaran.
                        </p>
                        </p>
                    </div>
                </section>

                <!-- FAQ Section -->
                <section class="faq-section">
                    <h2 class="section-title">FAQ</h2>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(0)">
                            Apakah identitas pelapor akan dirahasiakan?
                        </div>
                        <div class="faq-answer" id="faq-answer-0">
                             Ya, identitas pelapor akan dijaga kerahasiaannya sesuai dengan kebijakan privasi yang berlaku. Namun, untuk keperluan verifikasi dan tindak lanjut, tim SIPAMA mungkin perlu menghubungi pelapor melalui nomor kontak pelapor.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(1)">
                            Bagaimana cara mengajukan pengaduan?
                        </div>
                        <div class="faq-answer" id="faq-answer-1">
                            Untuk mengajukan pengaduan, klik tombol "Buat Pengaduan" di bagian bawah halaman ini. Isi form pengaduan dengan informasi yang lengkap dan jelas, termasuk kategori pengaduan, deskripsi masalah, lokasi kejadian, dan lampiran foto jika ada. Setelah itu, kirimkan pengaduan Anda dan tunggu konfirmasi dari tim SIPAMA.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(2)">
                            Apakah sebelum melakukan pengaduan harus mendaftar akun terlebih dahulu?
                        </div>
                        <div class="faq-answer" id="faq-answer-2">
                            Ya, untuk mengajukan pengaduan, Anda perlu mendaftar akun terlebih dahulu. Pendaftaran akun memungkinkan Anda untuk melacak status pengaduan Anda, menerima pembaruan, dan berkomunikasi dengan tim SIPAMA jika diperlukan.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(3)">
                            Bagaimana proses tindak lanjut pengaduan?
                        </div>
                        <div class="faq-answer" id="faq-answer-3">
                            Setelah pengaduan diajukan, tim SIPAMA akan memverifikasi informasi yang diberikan. Jika pengaduan valid, tim akan meneruskan laporan ke dinas terkait untuk ditindaklanjuti. Pelapor akan menerima pembaruan status pengaduan melalui akun mereka.
                        </div>
                    </div>

                    <!-- Tambahkan FAQ lain di sini -->
                </section>

<!-- Pending Reports Section -->
<section class="pending-section">
    <h2 class="section-title">📋 Kumpulan Pengaduan</h2>

    @if($pending->isEmpty())
        <p class="no-data">Tidak ada pengaduan.</p>
    @else
        <div class="pending-grid">
            @foreach($pending as $item)
                <div class="pending-card">
                    <p><strong>Kategori:</strong> {{ $item->pengaduan->kategori ?? '-' }}</p>
                    <p><strong>Lokasi:</strong> {{ $item->lokasi_kejadian }}</p>
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d M Y') }}</p>
                    <p><strong>Deskripsi:</strong> {{ Str::limit($item->deskripsi, 80) }}</p>
                    <p><strong>Keterangan:</strong> {{ $item->keterangan ?? '-' }}</p>

                    @if($item->bukti_foto)
                        <img src="{{ asset('storage/' . $item->bukti_foto) }}" alt="Bukti Foto" class="bukti-foto">
                    @else
                        <p><em>Tidak ada bukti foto</em></p>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($pending->hasPages())
<div class="pagination-wrapper">
  {{ $pending->links('pagination::bootstrap-5') }}
</div>
@endif
    @endif
</section>


            </div>
        </main>
    </div>

    {{-- Script --}}
    <script src="{{ asset('js/guest/dashboard.js') }}"></script>
</body>
</html>
