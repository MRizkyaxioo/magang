<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Hasil Pengaduan - SIMARA</title>
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
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            padding: 30px;
        }

        /* Main Title */
        .main-title {
            font-size: 32px;
            font-weight: 700;
            color: #2C1810;
            margin-bottom: 30px;
            text-align: left;
            position: relative;
            padding-bottom: 15px;
        }

        .main-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            border-radius: 2px;
        }

        /* Card Styles */
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.15);
            border: 2px solid #FFF8DC;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.1), transparent);
            transition: left 0.5s;
        }

        .info-card:hover::before {
            left: 100%;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 193, 7, 0.25);
            border-color: #F0E68C;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: #B8860B;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .card-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            border-radius: 2px;
        }

        /* Info Items */
        .info-item {
            display: flex;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
            align-items: flex-start;
        }

        .info-label {
            font-weight: 600;
            color: #8B4513;
            min-width: 140px;
            flex-shrink: 0;
            font-size: 14px;
        }

        .info-value {
            color: #2C1810;
            font-size: 14px;
            line-height: 1.5;
            flex: 1;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, #FFF8DC 0%, #F0E68C 100%);
            color: #B8860B;
            border: 1px solid #DAA520;
            text-transform: capitalize;
        }

        /* Photo Container */
        .photo-container {
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        .evidence-photo {
            max-width: 300px;
            width: 100%;
            height: auto;
            border-radius: 12px;
            border: 3px solid #F0E68C;
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .evidence-photo:hover {
            transform: scale(1.05);
            border-color: #FFD700;
            box-shadow: 0 12px 35px rgba(255, 193, 7, 0.5);
        }

        /* Back Button */
        .back-button {
            background: linear-gradient(135deg, #B8860B 0%, #DAA520 50%, #FFD700 100%);
            color: #2C1810;
            border: 2px solid #B8860B;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(184, 134, 11, 0.5);
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 50%, #FFA500 100%);
            text-decoration: none;
            color: #2C1810;
        }

        .back-button:active {
            transform: translateY(-1px);
        }

        .back-arrow {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .back-button:hover .back-arrow {
            transform: translateX(-3px);
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
            max-width: 90%;
            max-height: 90%;
            margin-top: 2%;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 20px;
                border-radius: 15px;
            }

            .main-title {
                font-size: 24px;
            }

            .info-item {
                flex-direction: column;
                gap: 5px;
            }

            .info-label {
                min-width: auto;
                font-size: 13px;
            }

            .info-value {
                font-size: 13px;
            }

            .evidence-photo {
                max-width: 100%;
            }

            .card-title {
                font-size: 18px;
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

        /* Fade in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="main-title">Detail Hasil Pengaduan</h1>

        <!-- Informasi Pengaduan Card -->
        <div class="info-card fade-in">
            <h2 class="card-title">Informasi Pengaduan</h2>
            
            <div class="info-item">
                <span class="info-label">Kategori:</span>
                <span class="info-value">{{ $hasilPengaduan->pengaduan->kategori ?? '-' }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Lokasi Kejadian:</span>
                <span class="info-value">{{ $hasilPengaduan->lokasi_kejadian }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Tanggal Kejadian:</span>
                <span class="info-value">{{ $hasilPengaduan->tanggal_kejadian }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Deskripsi:</span>
                <span class="info-value">{{ $hasilPengaduan->deskripsi }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Status:</span>
                <span class="info-value">
                    <span class="status-badge">{{ ucfirst($hasilPengaduan->status) }}</span>
                </span>
            </div>
            
@if($hasilPengaduan->bukti_foto)
            <div class="info-item">
                <span class="info-label">Bukti foto:</span>
                <div class="photo-container">
                    <img src="{{ asset('storage/'.$hasilPengaduan->bukti_foto) }}"
                     alt="Bukti Foto" 
                         class="evidence-photo"
                         onclick="openModal(this.src)">
@endif
                </div>
            </div>
        </div>

        <!-- Detail Pengadu Card -->
        <div class="info-card fade-in">
            <h2 class="card-title">Detail Pengadu</h2>
            
            <div class="info-item">
                <span class="info-label">NIK:</span>
                <span class="info-value">1234567891011121</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Nama:</span>
                <span class="info-value">Muhammad Fadhil</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Alamat:</span>
                <span class="info-value">barabai</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Tempat Lahir:</span>
                <span class="info-value">barabai</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Tanggal Lahir:</span>
                <span class="info-value">2005-05-03</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">No. Telepon:</span>
                <span class="info-value">087736567651</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">pengadu@example.com</span>
            </div>
        </div>

        <!-- Back Button -->
        <a href='{{ route('pengurus.dashboard') }}' class="back-button">
            <span class="back-arrow">←</span>
            Kembali ke halaman utama
        </a>
    </div>

    <!-- Modal for Image Preview -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script>
        // Back Button Function
        function goBack() {
            const confirmed = confirm('Apakah Anda yakin ingin kembali ke halaman utama?');
            if (confirmed) {
                // window.location.href = '/dashboard';
                alert('Mengarahkan ke halaman dashboard...');
                // Simulate navigation with loading
                const button = document.querySelector('.back-button');
                const originalText = button.innerHTML;
                button.innerHTML = '<span class="loading"></span>Loading...';
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    alert('Redirecting to dashboard page...');
                }, 1500);
            }
            return false; // Prevent default link behavior
        }

        // Image Modal Functions
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = imageSrc;
            
            // Add click event to close modal when clicking outside image
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Add smooth animations on page load
        window.addEventListener('load', function() {
            const cards = document.querySelectorAll('.info-card');
            
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.8s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Animate title
            const title = document.querySelector('.main-title');
            title.style.opacity = '0';
            title.style.transform = 'translateX(-30px)';
            title.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                title.style.opacity = '1';
                title.style.transform = 'translateX(0)';
            }, 100);

            // Animate back button
            const backBtn = document.querySelector('.back-button');
            backBtn.style.opacity = '0';
            backBtn.style.transform = 'translateY(20px)';
            backBtn.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                backBtn.style.opacity = '1';
                backBtn.style.transform = 'translateY(0)';
            }, 800);
        });

        // Add subtle parallax effect on scroll
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const cards = document.querySelectorAll('.info-card');
            
            cards.forEach((card, index) => {
                const speed = 0.02 + (index * 0.01);
                card.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Enhanced hover effects
        document.querySelectorAll('.info-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.boxShadow = '0 20px 50px rgba(255, 193, 7, 0.3)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '0 10px 30px rgba(255, 193, 7, 0.15)';
            });
        });
    </script>
</body>
</html>