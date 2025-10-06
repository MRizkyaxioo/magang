<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password - SIPAMA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px 40px 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 18px;
            padding: 4px;
        }

        .toggle-password:hover {
            color: #667eea;
        }

        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 6px;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #333;
            border: 2px solid #e0e0e0;
        }

        .btn-secondary:hover {
            background: #e9ecef;
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 12px 16px;
            margin-bottom: 24px;
            border-radius: 4px;
        }

        .info-box p {
            color: #0d47a1;
            font-size: 13px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Ubah Password</h1>
            <p>Ganti password Anda untuk keamanan akun</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="info-box">
            <p><strong>⚠️ Perhatian:</strong> Setelah password berhasil diubah, Anda akan otomatis logout dan harus login kembali dengan password baru.</p>
        </div>

        <form method="POST" action="{{ route('pengadu.change-password') }}">
            @csrf

            <div class="form-group">
                <label for="password_lama">Password Lama</label>
                <div class="input-wrapper">
                    <input type="password" id="password_lama" name="password_lama" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_lama')">
                        👁️
                    </button>
                </div>
                @error('password_lama')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_baru">Password Baru</label>
                <div class="input-wrapper">
                    <input type="password" id="password_baru" name="password_baru" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_baru')">
                        👁️
                    </button>
                </div>
                @error('password_baru')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <small style="color: #666; font-size: 12px;">Minimal 6 karakter</small>
            </div>

            <div class="form-group">
                <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                <div class="input-wrapper">
                    <input type="password" id="password_baru_confirmation" name="password_baru_confirmation" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_baru_confirmation')">
                        👁️
                    </button>
                </div>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('pengadu.dashboard') }}'">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling;
            
            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = '🙈';
            } else {
                input.type = 'password';
                button.textContent = '👁️';
            }
        }
    </script>
</body>
</html>