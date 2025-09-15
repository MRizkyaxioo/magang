<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIPAMA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pengadu/login.css') }}">
</head>
<body>
  <div class="container">
    <!-- Kiri -->
    <div class="left">
      <img src="{{ asset('images/logo_pemko.jpeg') }}" alt="Logo" width="200">
      <h2>Selamat Datang di SIPAMA</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-warning">
          {{ session('error') }}
        </div>
      @endif
    </div>

    <!-- Kanan -->
    <div class="right">
      <h2>Login</h2>
      <form method="POST" action="{{ route('pengadu.login') }}">
        @csrf
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
          <i class="fas fa-eye toggle-password"></i>
        </div>
        <button type="submit" class="btn-login">Login</button>
      </form>

      <div class="register">
        <p>Belum punya akun?</p>
        <a href="{{ route('pengadu.register') }}">
          <button class="btn-register" type="button">Register</button>
        </a>
      </div>
    </div>
  </div>

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/6d3c1c4a0b.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/pengadu/login.js') }}"></script>
</body>
</html>
