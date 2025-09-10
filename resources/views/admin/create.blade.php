<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Pengurus - SIPAMA</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        /* Form Container */
        .form-container {
            background: linear-gradient(135deg, #FFFF00 0%, #FFD700 50%, #FFA500 100%);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Main Title */
        .main-title {
            font-size: 32px;
            font-weight: 700;
            color: #2C1810;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .main-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #8B4513, #2C1810);
            border-radius: 2px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #2C1810;
            margin-bottom: 8px;
            font-size: 16px;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 3px solid rgba(255, 255, 255, 0.8);
            border-radius: 25px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            color: #2C1810;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 1);
            background: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: #8B4513;
            opacity: 0.7;
        }

        /* Select Dropdown */
        .form-select {
            width: 100%;
            padding: 15px 20px;
            border: 3px solid rgba(255, 255, 255, 0.8);
            border-radius: 25px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            color: #2C1810;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 20px center;
            background-repeat: no-repeat;
            background-size: 16px;
        }

        .form-select:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 1);
            background-color: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Button Container */
        .button-container {
            display: flex;
            gap: 20px;
            margin-top: 35px;
            position: relative;
            z-index: 1;
        }

        /* Primary Button */
        .btn-primary {
            flex: 1;
            background: linear-gradient(135deg, #8B4513 0%, #2C1810 100%);
            color: white;
            border: 3px solid rgba(255, 255, 255, 0.8);
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(139, 69, 19, 0.6);
            background: linear-gradient(135deg, #2C1810 0%, #8B4513 100%);
            border-color: white;
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        /* Secondary Button */
        .btn-secondary {
            flex: 1;
            background: rgba(255, 255, 255, 0.9);
            color: #2C1810;
            border: 3px solid rgba(255, 255, 255, 0.8);
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 255, 255, 0.6);
            background: white;
            border-color: #2C1810;
            color: #2C1810;
            text-decoration: none;
        }

        /* Error Alert */
        .alert-danger {
            background: linear-gradient(135deg, #FFB6C1 0%, #FF69B4 100%);
            color: #8B008B;
            border: 2px solid #FF1493;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 25px rgba(255, 20, 147, 0.3);
        }

        .alert-danger ul {
            list-style: none;
            margin: 0;
        }

        .alert-danger li {
            margin-bottom: 8px;
            font-weight: 500;
        }

        .alert-danger li::before {
            content: '⚠️ ';
            margin-right: 8px;
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 20px;
            }

            .form-container {
                padding: 30px 25px;
            }

            .main-title {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .button-container {
                flex-direction: column;
                gap: 15px;
            }

            .form-input,
            .form-select,
            .btn-primary,
            .btn-secondary {
                font-size: 16px;
                padding: 12px 18px;
            }
        }

        /* Input Validation States */
        .form-input.invalid {
            border-color: #FF1493;
            background-color: #FFE4E1;
            animation: shake 0.5s ease-in-out;
        }

        .form-input.valid {
            border-color: #32CD32;
            background-color: #F0FFF0;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 5px;
            font-size: 12px;
            display: none;
        }

        .password-strength.show {
            display: block;
        }

        .strength-weak {
            color: #FF1493;
        }

        .strength-medium {
            color: #FFA500;
        }

        .strength-strong {
            color: #32CD32;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="main-title">Buat Akun Pengurus</h1>

            <!-- Error Messages (Hidden by default) -->
            <div class="alert-danger" id="errorAlert" style="display: none;">
                <ul id="errorList">
                    <!-- Error messages will be populated here -->
                </ul>
            </div>

            <form id="registrationForm" action="{{ route('pengurus.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="instansi">Nama Instansi</label>
                    <input type="text"
                           id="instansi"
                           name="instansi_pemerintahan"
                           class="form-input"
                           placeholder="Masukkan nama instansi pemerintahan"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Pengurus</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-input"
                           placeholder="contoh@instansi.go.id"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-input"
                           placeholder="Masukkan password yang kuat"
                           required>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-input"
                           placeholder="Ulangi password yang sama"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="kategori">Kategori Pengaduan</label>
                    <select id="kategori" name="id_pengaduan" class="form-select" required>
                        <option value="">-- Pilih Kategori Pengaduan --</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id_pengaduan }}">{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn-primary" id="submitBtn">
                        Buat Akun
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
                        Kembali ke dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#8B4513',
    confirmButtonText: 'OK'
});
</script>
@endif


    <script>

        // Form validation and submission
document.getElementById('registrationForm').addEventListener('submit', function(e) {

        hideErrors();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        const errors = validateForm(data);
        if (errors.length > 0) {
            e.preventDefault();
            showErrors(errors);
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="loading"></span>Membuat Akun...';
        submitBtn.disabled = true;

        setTimeout(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                html: `
                    Akun pengurus berhasil dibuat.<br><br>
                    <b>Instansi:</b> ${data.instansi_pemerintahan}<br>
                    <b>Email:</b> ${data.email}<br>
                    <b>Kategori:</b> ${getKategoriName(data.id_pengaduan)}
                `,
                confirmButtonColor: '#8B4513',
                confirmButtonText: 'OK'
            });

            this.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            clearValidationStates();
        }, 1500);
        });

        // Form validation function
        function validateForm(data) {
            const errors = [];

            if (!data.instansi_pemerintahan || data.instansi_pemerintahan.length < 3) {
                errors.push('Nama instansi harus diisi minimal 3 karakter');
                markInvalid('instansi');
            } else {
                markValid('instansi');
            }

            if (!data.email || !isValidEmail(data.email)) {
                errors.push('Email tidak valid atau belum diisi');
                markInvalid('email');
            } else {
                markValid('email');
            }

            if (!data.password || data.password.length < 6) {
                errors.push('Password harus minimal 6 karakter');
                markInvalid('password');
            } else {
                markValid('password');
            }

            if (data.password !== data.password_confirmation) {
                errors.push('Konfirmasi password tidak cocok');
                markInvalid('password_confirmation');
            } else if (data.password_confirmation) {
                markValid('password_confirmation');
            }

            if (!data.id_pengaduan) {
                errors.push('Kategori pengaduan harus dipilih');
                markInvalid('kategori');
            } else {
                markValid('kategori');
            }

            return errors;
        }

        // Email validation
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Mark input as invalid
        function markInvalid(fieldId) {
            const field = document.getElementById(fieldId);
            field.classList.remove('valid');
            field.classList.add('invalid');
        }

        // Mark input as valid
        function markValid(fieldId) {
            const field = document.getElementById(fieldId);
            field.classList.remove('invalid');
            field.classList.add('valid');
        }

        // Clear validation states
        function clearValidationStates() {
            const inputs = document.querySelectorAll('.form-input, .form-select');
            inputs.forEach(input => {
                input.classList.remove('valid', 'invalid');
            });
        }

        // Show errors
        function showErrors(errors) {
            const errorAlert = document.getElementById('errorAlert');
            const errorList = document.getElementById('errorList');

            errorList.innerHTML = '';
            errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });

            errorAlert.style.display = 'block';
            errorAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // Hide errors
        function hideErrors() {
            document.getElementById('errorAlert').style.display = 'none';
        }

        // Get category name by ID
        function getKategoriName(id) {
            const categories = {
                '1': 'Infrastruktur',
                '2': 'Lingkungan',
                '3': 'Pelayanan Publik',
                '4': 'Keamanan',
                '5': 'Sosial',
                '6': 'Ekonomi',
                '7': 'Pendidikan',
                '8': 'Kesehatan'
            };
            return categories[id] || 'Tidak diketahui';
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('passwordStrength');

            if (password.length === 0) {
                strengthDiv.classList.remove('show');
                return;
            }

            strengthDiv.classList.add('show');

            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            if (strength <= 2) {
                strengthDiv.textContent = 'Password lemah';
                strengthDiv.className = 'password-strength show strength-weak';
            } else if (strength <= 3) {
                strengthDiv.textContent = 'Password sedang';
                strengthDiv.className = 'password-strength show strength-medium';
            } else {
                strengthDiv.textContent = 'Password kuat';
                strengthDiv.className = 'password-strength show strength-strong';
            }
        });

        // Back button function
        function goBack() {
            const confirmed = confirm('Apakah Anda yakin ingin kembali ke dashboard?\nData yang belum disimpan akan hilang.');
            if (confirmed) {
                alert('Mengarahkan ke dashboard admin...');
                // window.location.href = '/admin/dashboard';
            }
            return false;
        }

        // Real-time validation on input
        document.querySelectorAll('.form-input, .form-select').forEach(input => {
            input.addEventListener('blur', function() {
                const formData = new FormData(document.getElementById('registrationForm'));
                const data = Object.fromEntries(formData);

                // Validate only this field
                if (this.name === 'instansi_pemerintahan') {
                    if (!data.instansi_pemerintahan || data.instansi_pemerintahan.length < 3) {
                        markInvalid('instansi');
                    } else {
                        markValid('instansi');
                    }
                } else if (this.name === 'email') {
                    if (!data.email || !isValidEmail(data.email)) {
                        markInvalid('email');
                    } else {
                        markValid('email');
                    }
                } else if (this.name === 'password') {
                    if (!data.password || data.password.length < 6) {
                        markInvalid('password');
                    } else {
                        markValid('password');
                    }
                } else if (this.name === 'password_confirmation') {
                    if (data.password !== data.password_confirmation) {
                        markInvalid('password_confirmation');
                    } else if (data.password_confirmation) {
                        markValid('password_confirmation');
                    }
                } else if (this.name === 'id_pengaduan') {
                    if (!data.id_pengaduan) {
                        markInvalid('kategori');
                    } else {
                        markValid('kategori');
                    }
                }
            });
        });

        // Add smooth animations on page load
        window.addEventListener('load', function() {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'scale(0.9) translateY(20px)';
            container.style.transition = 'all 0.8s ease';

            setTimeout(() => {
                container.style.opacity = '1';
                container.style.transform = 'scale(1) translateY(0)';
            }, 100);

            // Animate form elements
            const formElements = document.querySelectorAll('.form-group, .button-container');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 300 + (index * 100));
            });
        });
    </script>
</body>
</html>
