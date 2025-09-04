<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMARA - Sistem Informasi Masyarakat Raya</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #B8860B 0%, #DAA520 50%, #FFD700 100%);
            color: #2C1810;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 200px;
            height: 150px;
            align-items: center;
            justify-content: center;
        }

        .logo::before {
            content: '🏛️';
            font-size: 20px;
            margin-bottom: 2px;
        }

        .logo-text {
            font-size: 8px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .title-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px 40px;
            border-radius: 12px;
            border: 2px solid #B8860B;
        }

        .title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 3px;
            color: #B8860B;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            color: #2C1810;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            padding: 40px 30px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .simara-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
            border: 2px solid #FFF8DC;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            color: #B8860B;
            margin-bottom: 20px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            border-radius: 2px;
        }

        .info-box {
            background: linear-gradient(135deg, #FFFACD 0%, #FFF8DC 100%);
            border: 2px solid #F0E68C;
            border-radius: 15px;
            padding: 30px;
            margin-top: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .info-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
            transition: left 0.5s;
        }

        .info-box:hover::before {
            left: 100%;
        }

        .info-text {
            font-size: 18px;
            color: #8B4513;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        /* Right Sidebar */
        .complaint-section {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
            border: 2px solid #FFF8DC;
            height: fit-content;
        }

        .complaint-title {
            font-size: 22px;
            font-weight: 600;
            color: #B8860B;
            margin-bottom: 20px;
            text-align: center;
        }

        .complaint-description {
            background: #FFFACD;
            border: 1px solid #F0E68C;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #8B4513;
            line-height: 1.6;
            min-height: 120px;
        }

        .complaint-button {
            width: 100%;
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #2C1810;
            border: 2px solid #B8860B;
            padding: 15px 25px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            margin-bottom: 15px;  /* ✅ ini yang bikin jarak */
        }

        .complaint-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 193, 7, 0.6);
            background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        }

        .complaint-button:active {
            transform: translateY(-1px);
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 40px;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
            border: 2px solid #FFF8DC;
        }

        .faq-item {
            margin-bottom: 15px;
        }

        .faq-dropdown {
            background: white;
            border: 2px solid #F0E68C;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 16px;
            color: #8B4513;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            width: 100%;
        }

        .faq-dropdown:hover {
            border-color: #FFD700;
            box-shadow: 0 5px 20px rgba(255, 193, 7, 0.3);
            background: #FFFACD;
        }

        .faq-dropdown::after {
            content: '▼';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #B8860B;
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .faq-dropdown.active {
            background: #FFD700;
            color: #2C1810;
            border-color: #B8860B;
        }

        .faq-dropdown.active::after {
            transform: translateY(-50%) rotate(180deg);
        }

        .faq-answer {
            background: #FFFACD;
            border: 1px solid #F0E68C;
            border-radius: 0 0 12px 12px;
            border-top: none;
            padding: 20px;
            color: #8B4513;
            line-height: 1.6;
            display: none;
            animation: slideDown 0.3s ease;
        }

        .faq-answer.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .logo-section {
                flex-direction: column;
                gap: 10px;
            }

            .title {
                font-size: 24px;
            }

            .main-content {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 20px;
            }

            .container {
                margin: 10px;
                border-radius: 15px;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #FFD700;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
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
                    <h1 class="title">Selamat Datang, {{ Auth::guard('pengadu')->user()->nama_pengadu }} 🎉</h1>
                </div>
            </div>
            <form class="logout-btn" method="POST" action="{{ route('pengadu.logout') }}">
    @csrf
    <button type="submit" style="all:unset;cursor:pointer;display:flex;align-items:center;gap:8px;">
        <span>Logout</span>
        <span>↗</span>
    </button>
</form>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <div class="left-content">
                <!-- SIMARA Section -->
                <section class="simara-section">
                    <h2 class="section-title">SIMARA</h2>
                    <div class="info-box">
                        <p class="info-text">
                            Sistem Pengaduan Masyarakat (SIMARA) adalah platform digital yang memungkinkan masyarakat Banjarmasin untuk menyampaikan aspirasi, keluhan, dan laporan secara online. Sistem ini dirancang untuk meningkatkan pelayanan publik dan transparansi pemerintahan kota.
                        </p>
                    </div>
                </section>

                <!-- FAQ Section -->
                <section class="faq-section">
                    <h2 class="section-title">FAQ</h2>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(0)">
                            Berapa lama waktu pengaduan untuk ditindaklanjuti?
                        </div>
                        <div class="faq-answer" id="faq-answer-0">
                            Pengaduan akan di proses paling lama 4 hari, jika tidak ada info lebih lanjut pengadu bisa melakukan pengaduan ulang atau bisa hubungi nomor ini 081234567891
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(1)">
                            Apakah identitas pelapor akan dirahasiakan?
                        </div>
                        <div class="faq-answer" id="faq-answer-1">
                            Ya, identitas pelapor akan dijaga kerahasiaannya sesuai dengan kebijakan privasi yang berlaku. Namun, untuk keperluan verifikasi dan tindak lanjut, tim SIMARA mungkin perlu menghubungi pelapor melalui nomor kontak pelapor.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(2)">
                            Bagaimana cara melaporkan pungutan liar?
                        </div>
                        <div class="faq-answer" id="faq-answer-2">
                            Untuk melaporkan pungutan liar, Anda dapat menggunakan form pengaduan dengan memilih kategori "Pungutan Liar". Sertakan informasi detail seperti lokasi, waktu kejadian, dan bukti pendukung (foto) jika ada.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-dropdown" onclick="toggleFAQ(3)">
                            Apakah laporan saya akan segera ditindaklanjuti?
                        </div>
                        <div class="faq-answer" id="faq-answer-3">
                            Setiap laporan yang masuk akan diverifikasi terlebih dahulu oleh tim SIMARA. Anda akan dihubungi oleh pihak terkait untuk ditindaklanjuti. Status laporan dapat dilihat pada riwayat pengaduan.
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Sidebar -->
            <aside class="complaint-section">
                <h3 class="complaint-title">Sampaikan Laporan Anda</h3>
                <div class="complaint-description">
                    Sampaikan keluhan, saran, atau aspirasi Anda kepada Pemerintah Kota Banjarmasin melalui form pengaduan online. Tim kami akan merespon dan menindaklanjuti laporan Anda dengan cepat dan tepat.

                    <br><br><strong>Jenis Laporan:</strong>
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

    <script>
        // FAQ Toggle Function
        function toggleFAQ(index) {
            const dropdown = document.querySelectorAll('.faq-dropdown')[index];
            const answer = document.getElementById(`faq-answer-${index}`);

            // Close all other FAQ items
            document.querySelectorAll('.faq-dropdown').forEach((item, i) => {
                if (i !== index) {
                    item.classList.remove('active');
                    document.getElementById(`faq-answer-${i}`).classList.remove('show');
                }
            });

            // Toggle current FAQ item
            dropdown.classList.toggle('active');
            answer.classList.toggle('show');
        }

        // Logout Function
        function logout() {
            const confirmed = confirm('Apakah Anda yakin ingin keluar dari sistem SIMARA?');
            if (confirmed) {
                alert('Anda telah berhasil logout dari sistem SIMARA. Terima kasih telah menggunakan layanan kami.');
                // Here you would typically redirect to login page
                // window.location.href = '/login';
            }
        }

        // Complaint Form Function
        function openComplaintForm(url) {
            const button = document.querySelector('.complaint-button');
            const originalText = button.innerHTML;

            // Show loading state
            button.innerHTML = '<span class="loading"></span>Memuat Form...';
            button.disabled = true;

            // Simulate loading lalu redirect
            setTimeout(() => {
                // Redirect ke form pengaduan
                window.location.href = url;
            }, 1500); // 1.5 detik animasi sebelum pindah

            // Optional: reset tombol jika redirect gagal (fallback)
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 3000);
        }

        // Add smooth animations on page load
        window.addEventListener('load', function() {
            const elements = document.querySelectorAll('.simara-section, .complaint-section, .faq-section');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });

        // Add hover effects to cards
        document.querySelectorAll('.simara-section, .complaint-section, .faq-section').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 20px 40px rgba(255, 193, 7, 0.3)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 15px 35px rgba(255, 193, 7, 0.2)';
            });
        });
    </script>
</body>
</html>
