<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengaduan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            width: 95%; /* biar fleksibel */
            margin: 0 auto;
            background: #F5F5F5;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Header dengan logo */
        .dashboard-header {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-container {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .logo-text {
            color: #B8860B;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            line-height: 1.2;
        }

        .welcome-text {
            background: white;
            color: #333;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background: #FF6B6B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .logout-btn:hover {
            background: #FF5252;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        /* Stats Cards */
        .stats-section {
            background: white;
            padding: 30px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: #FFFACD;
            border: 2px solid #F0E68C;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #B8860B;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: #8B4513;
            font-weight: 500;
        }

        /* Main Content Area */
        .main-content {
            background: white;
            padding: 30px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            min-height: 400px;
        }

        /* Detail Section */
        .detail-section {
            background: #F9F9F9;
            border-radius: 15px;
            padding: 25px;
            border: 2px solid #F0E68C;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #FFD700;
            padding-bottom: 10px;
        }

        .info-section {
            background: #FFFACD;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #F0E68C;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #8B4513;
            width: 140px;
            flex-shrink: 0;
        }

        .info-value {
            color: #333;
            flex: 1;
        }

        .status-badge {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .kategori-badge {
            display: inline-block;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #2C1810;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .bukti-foto {
            max-width: 300px;
            max-height: 200px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-top: 10px;
        }

        .bukti-foto:hover {
            transform: scale(1.05);
        }

        /* Pengadu Detail Section */
        .pengadu-section {
            background: #F0F8FF;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #E0E0E0;
        }

        /* Right Sidebar */
        .sidebar {
            background: #FFFACD;
            border-radius: 15px;
            padding: 25px;
            border: 2px solid #F0E68C;
            height: fit-content;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 600;
            color: #B8860B;
            margin-bottom: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .filter-section {
            margin-bottom: 20px;
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
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            color: #8B4513;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .filter-select:focus {
            outline: none;
            border-color: #FFD700;
        }

        .action-btn {
            width: 100%;
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #2C1810;
            border: 2px solid #B8860B;
            padding: 12px 20px;
            border-radius: 8px;
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
            margin-bottom: 10px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
            text-decoration: none;
            color: #2C1810;
        }

        .back-btn {
            background: #6C757D;
            color: white;
            border: 2px solid #495057;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
        }

        .back-btn:hover {
            background: #5A6268;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(108, 117, 125, 0.3);
            text-decoration: none;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .header-left {
                flex-direction: column;
                gap: 10px;
            }

            .stats-section {
                grid-template-columns: 1fr;
                gap: 15px;
                padding: 20px;
            }

            .main-content {
                padding: 20px;
            }
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            cursor: pointer;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90%;
            max-height: 90%;
        }

        .modal img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }
    </style>
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
                            <span class="kategori-badge"> {{ $hasil->pengaduan->kategori ?? '-' }}</span>
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

    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }


        // Add event listeners
        document.getElementById('statusFilter').addEventListener('change', filterByStatus);
        document.getElementById('kategoriFilter').addEventListener('change', filterByKategori);

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
