<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pengadu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h3>Dashboard Pengurus</h3>
        </div>
        <div class="card-body text-center">
            <h4>Selamat Datang Admin {{ Auth::guard('pengurus')->user()->instansi_pemerintahan }} 🎉</h4>
            <p class="text-muted">Senang melihat Anda di sini!</p>

            <form method="POST" action="{{ route('pengurus.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
