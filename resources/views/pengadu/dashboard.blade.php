<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAMA - Sistem Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{ asset('css/pengadu/dashboard.css') }}">
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
                    <h1 class="title">Selamat Datang, {{ Auth::guard('pengadu')->user()->nama_pengadu }} </h1>
                </div>
            <div class="profile-icon" style="cursor:pointer;" onclick="window.location.href='{{ route('pengadu.edit-profil') }}'">
    👤
</div>

        </header>

        <!-- Main Content -->
        <main class="main-content">
            <div class="left-content">
                <!-- SIMARA Section -->
                <section class="simara-section">
                    <h2 class="section-title">SIPAMA</h2>
                    <div class="info-box">
                        <p class="info-text">
                            Sistem Pengaduan Masyarakat (SIPAMA) adalah platform digital yang memungkinkan masyarakat Banjarmasin untuk menyampaikan aspirasi, keluhan, dan laporan secara online. Sistem ini dirancang untuk meningkatkan pelayanan publik dan transparansi pemerintahan kota.
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
                            Berapa lama waktu pengaduan untuk ditindaklanjuti?
                        </div>
                        <div class="faq-answer" id="faq-answer-1">
                            Pengaduan akan di proses paling lama 4 hari, jika tidak ada info lebih lanjut pengadu bisa melakukan pengaduan ulang atau bisa hubungi nomor ini 081234567891.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(2)">
                            Bagaimana laporan saya akan ditindaklanjuti?
                        </div>
                        <div class="faq-answer" id="faq-answer-2">
                            Setelah pengaduan diajukan, sistem akan otomatis mengirim pengaduan kepada pihak terkait. Pengadu dapat memantau status pengaduan pada riwayat pengaduan masing-masing.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(3)">
                            Bagaimana cara memantau status laporan saya?
                        </div>
                        <div class="faq-answer" id="faq-answer-3">
                            Pengadu dapat memantau status laporan melalui fitur "Riwayat Pengaduan" di dashboard SIPAMA. Setiap perubahan status akan diinformasikan melalui notifikasi di aplikasi atau email yang terdaftar.
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Sidebar -->
            <aside class="complaint-section">
                <h3 class="complaint-title">Sampaikan Laporan Anda</h3>
                <div class="complaint-description">
                    Sampaikan keluhan, saran, atau aspirasi Anda kepada Pemerintah Kota Banjarmasin melalui form pengaduan online. Tim kami akan merespon dan menindaklanjuti laporan Anda dengan cepat dan tepat.

                    <br><br><strong>Kategori Laporan:</strong>
                    @foreach($pengaduan as $item)
                        <br>• {{ $item->kategori }}
                    @endforeach
                </div>
                <button class="complaint-button" onclick="window.location.href='{{ route('pengadu.form') }}'">
                    📝 Ajukan Pengaduan
                </button>
                <button class="complaint-button" onclick="window.location.href='{{ route('pengadu.riwayat') }}'">
                    ⌛ Riwayat Pengaduan
                </button>
            </aside>
        </main>
    </div>

    <script src="{{ asset('js/pengadu/dashboard.js') }}"></script>
</body>
</html>
