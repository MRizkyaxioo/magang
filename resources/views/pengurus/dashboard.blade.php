<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengurus</title>
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
            width: 150px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .logo::before {
            font-size: 20px;
            margin-bottom: 2px;
        }

        .title-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px 40px;
            border-radius: 12px;
            border: 2px solid #B8860B;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
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
            padding: 30px;
        }

        .table-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
            border: 2px solid #FFF8DC;
            overflow-x: auto;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #B8860B;
            margin-bottom: 30px;
            position: relative;
            text-align: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            border-radius: 2px;
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.1);
        }

        .data-table thead {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        }

        .data-table th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 600;
            color: #2C1810;
            font-size: 16px;
            border-bottom: 2px solid #B8860B;
            position: relative;
        }

        .data-table th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #B8860B, transparent);
        }

        .data-table td {
            padding: 20px 15px;
            border-bottom: 1px solid #FFF8DC;
            color: #8B4513;
            font-size: 14px;
            vertical-align: middle;
        }

        .data-table tbody tr {
            transition: all 0.3s ease;
            background: white;
        }

        .data-table tbody tr:nth-child(even) {
            background: #FFFACD;
        }

        .data-table tbody tr:hover {
            background: linear-gradient(135deg, #FFF8DC 0%, #FFFACD 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.2);
        }

        /* Photo Preview */
        .photo-preview {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #F0E68C;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .photo-preview:hover {
            transform: scale(1.1);
            border-color: #FFD700;
            box-shadow: 0 5px 20px rgba(255, 193, 7, 0.4);
        }

        /* Status Badge */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            display: inline-block;
            min-width: 120px;
        }

        .status-working {
            background: linear-gradient(135deg, #FFF8DC 0%, #F0E68C 100%);
            color: #B8860B;
            border: 1px solid #DAA520;
        }

        /* Action Buttons */
        .action-section {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .status-dropdown {
            background: white;
            border: 2px solid #F0E68C;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            color: #8B4513;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 140px;
        }

        .status-dropdown:hover {
            border-color: #FFD700;
            background: #FFFACD;
        }

        .update-btn {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #2C1810;
            border: 2px solid #B8860B;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .update-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
            background: linear-gradient(135deg, #FFA500 0%, #FF8C00 100%);
        }

        .detail-btn {
            background: rgba(255, 255, 255, 0.9);
            color: #B8860B;
            border: 2px solid #B8860B;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .detail-btn:hover {
            background: #B8860B;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 134, 11, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                padding: 20px;
            }

            .data-table th,
            .data-table td {
                padding: 15px 10px;
                font-size: 12px;
            }

            .photo-preview {
                width: 60px;
                height: 45px;
            }
        }

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
                font-size: 20px;
            }

            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .table-section {
                padding: 20px;
                overflow-x: scroll;
            }

            .data-table {
                min-width: 800px;
            }

            .action-section {
                flex-direction: column;
                gap: 5px;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #FFD700;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Modal for Image Preview */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            display: block;
            margin: auto;
            max-width: 80%;
            max-height: 80%;
            margin-top: 5%;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .close:hover {
            color: #FFD700;
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo-section">
                <div class="logo">
<img src="{{ asset('images/logo_pemko.png') }}" alt="Logo" class="logo">
                </div>
                <div class="title-section">
                    <h1 class="title">Selamat Datang, {{ Auth::guard('pengurus')->user()->instansi_pemerintahan }} 🎉</h1>
                </div>
            </div>
    <form action="{{ route('pengurus.logout') }}" method="POST" style="margin: 0; position: absolute; top: 20px; right: 30px;">
        @csrf
        <button type="submit" class="logout-btn" style="width:auto; padding:10px 20px; border-radius:8px;">
            <span>🚪</span>
            Logout
        </button>
    </form>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <section class="table-section">
                <h2 class="section-title">Data Laporan</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Bukti Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($hasilPengaduan as $pengaduan)
                        <tr>
                            <td>{{ $pengaduan->id_hasil }}</td>
                            <td>{{ $pengaduan->lokasi_kejadian }}</td>
                            <td>{{ $pengaduan->deskripsi }}</td>
                            <td>{{ $pengaduan->tanggal_kejadian }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$pengaduan->bukti_foto) }}"
                                    alt="Bukti Foto Pengaduan"
                                     class="photo-preview"
                                     onclick="openModal(this.src)">
                            </td>
                            <td>
                                <span class="status-badge status-working">{{ $pengaduan->status }}</span>
                            </td>
                            <td>
                                <form action="{{ route('pengurus.updateStatus', $pengaduan->id_hasil) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <select name="status" class="status-dropdown">
                                    <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="sedang dikerjakan" {{ $pengaduan->status == 'sedang dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="update-btn">Update</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('pengurus.hasil.detail', $pengaduan->id_hasil) }}" class="detail-btn">Lihat Detail</a>
                            </td>
                        </tr>
    @endforeach

                    </tbody>
                </table>
            </section>
        </main>
    </div>


    <script>



        // Image Modal Functions
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = imageSrc;
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Add smooth animations on page load
        window.addEventListener('load', function() {
            const table = document.querySelector('.table-section');
            table.style.opacity = '0';
            table.style.transform = 'translateY(30px)';
            table.style.transition = 'all 0.8s ease';

            setTimeout(() => {
                table.style.opacity = '1';
                table.style.transform = 'translateY(0)';
            }, 300);

            // Animate table rows
            const rows = document.querySelectorAll('.data-table tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                row.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, 500 + (index * 100));
            });
        });

        // Add hover effects to table section
        document.querySelector('.table-section').addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 20px 40px rgba(255, 193, 7, 0.3)';
        });

        document.querySelector('.table-section').addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 15px 35px rgba(255, 193, 7, 0.2)';
        });
    </script>
</body>
</html>
