<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMARA - Dashboard</title>
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
            max-width: 1400px;
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
            padding: 25px 40px;
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
            font-size: 20px;
            margin-bottom: 2px;
        }

        .title-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px 30px;
            border-radius: 12px;
            border: 2px solid #B8860B;

            min-width: 800px;   /* supaya ada lebar minimum */
            max-width: 900px;   /* kalau mau dibatasi maksimal */
            flex: 1;
            margin: 0 50px; /* kasih jarak dari logo dan tombol login */
            text-align: center; /* biar teks tetap rapi */
        }

        .dashboard-title {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #B8860B;
            text-align: center; /* kalau mau ditengah */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 5px;
        }

        .dashboard-subtitle {
            font-size: 16px;
            opacity: 0.8;
            font-weight: 500;
            color: #8B4513;
        }

        .login-btn {
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
            text-decoration: none;
        }

        .login-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            color: #2C1810;
        }

        /* Stats Section */
        .stats-section {
            padding: 30px 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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

        /* Main Content */
        .main-content {
            padding: 0 40px 40px 40px;
            display: grid;
             grid-template-columns: 1fr; /* hanya 1 kolom penuh */
            gap: 40px;
            align-items: start;
        }

        .left-content {
            display: flex;
            flex-direction: column;
            gap: 30px;
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
            font-size: 16px;
            color: #8B4513;
            font-weight: 500;
            position: relative;
            z-index: 1;
            line-height: 1.6;
        }

        /* FAQ Section */
        .faq-section {
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
            margin-bottom: 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .complaint-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 193, 7, 0.6);
            background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
            text-decoration: none;
            color: #2C1810;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .complaint-section {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .logo-section {
                flex-direction: column;
                gap: 10px;
            }

            .dashboard-title {
                font-size: 28px;
            }

            .stats-section, .main-content {
                padding: 20px;
            }

            .stats-section {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
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

        /* Animation */
        .stat-card, .simara-section, .faq-section, .complaint-section {
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

        /* Stagger animation */
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        .stat-card:nth-child(5) { animation-delay: 0.5s; }
        .simara-section { animation-delay: 0.6s; }
        .faq-section { animation-delay: 0.7s; }
        .complaint-section { animation-delay: 0.8s; }
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
                    <h1 class="dashboard-title">📋 Dashboard Utama</h1>
                    <p class="dashboard-subtitle">Sistem Informasi Masyarakat (SIMARA)</p>
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

        // Add smooth animations on page load
        window.addEventListener('load', function() {
            // Auto-refresh stats setiap 30 detik
            setInterval(() => {
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    stat.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        stat.style.transform = 'scale(1)';
                    }, 200);
                });
            }, 30000);

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
        });

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
</body>
</html>
