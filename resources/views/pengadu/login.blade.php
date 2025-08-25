<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIMARA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #FFD700;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: white;
      width: 800px;
      height: 500px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: space-around;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .left {
      text-align: center;
    }

    .left img {
    width: 350px !important;
    height: auto;
    margin-bottom: 20px;
    }

    .left h2 {
      font-size: 20px;
      font-weight: 700;
    }

    .right {
      width: 300px;
    }

    .right h2 {
      text-align: center;
      font-size: 22px;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .input-group {
      display: flex;
      align-items: center;
      border: 2px solid #ccc;
      border-radius: 8px;
      padding: 8px 12px;
      margin-bottom: 15px;
    }

    .input-group input {
      border: none;
      outline: none;
      flex: 1;
      font-size: 14px;
    }

    .input-group i {
      margin-right: 8px;
      color: #333;
    }

    .btn-login {
      width: 100%;
      background: #FFD700;
      border: none;
      padding: 10px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      margin-bottom: 15px;
    }

    .register {
      text-align: center;
      font-size: 14px;
    }

    .btn-register {
      margin-top: 5px;
      padding: 10px;
      width: 100%;
      border: 2px solid #333;
      border-radius: 8px;
      background: transparent;
      font-weight: 600;
      cursor: pointer;
    }
  </style>
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <!-- Kiri -->
    <div class="left">
      <img src="{{ asset('images/logo_pemko.jpeg') }}" alt="Logo" width="200">
      <h2>Selamat Datang di SIMARA</h2>
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
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
          <i class="fas fa-eye"></i>
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
</body>
</html>
