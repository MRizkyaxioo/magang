<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  {{-- Load CSS --}}
  <link rel="stylesheet" href="{{ asset('css/pengadu/register.css') }}">
</head>
<body>
  <main class="card">
    <h1>Register</h1>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form method="POST" action="{{ route('pengadu.register') }}" autocomplete="on" novalidate>
        @csrf
      <!-- kolom kiri -->
      <div class="field">
        <label for="nama">Nama</label>
        <div class="control">
          <input id="nama" name="nama_pengadu" type="text" placeholder="Nama lengkap" value="{{ old('nama_pengadu') }}" required />
        </div>
      </div>

      <div class="field">
        <label for="telp">No. Telpon</label>
        <div class="control">
          <input id="telp" name="no_telp" type="tel" inputmode="numeric" placeholder="08xxxxxxxxxx" value="{{ old('no_telp') }}" required />
        </div>
      </div>

      <div class="field">
        <label for="nik">NIK</label>
        <div class="control">
          <input id="nik" name="nik" type="text" inputmode="numeric" maxlength="16" placeholder="16 digit" value="{{ old('nik') }}" required />
        </div>
      </div>

      <div class="field">
        <label for="email">Email</label>
        <div class="control">
          <input id="email" name="email" type="email" placeholder="nama@email.com" value="{{ old('email') }}" required />
        </div>
      </div>

      <div class="field">
        <label for="alamat">Alamat</label>
        <div class="control">
          <textarea id="alamat" name="alamat" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
        </div>
      </div>

      <div class="field">
        <label for="password">Password</label>
        <div class="control">
          <input id="password" name="password" type="password" minlength="6" required />
          <button class="eye-btn" type="button" aria-label="Tampilkan password" data-toggle="password" data-target="#password">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="field">
        <label for="tempat_lahir">Tempat Lahir</label>
        <div class="control">
          <input id="tempat_lahir" name="tempat_lahir" type="text" placeholder="Kota/Kabupaten" value="{{ old('tempat_lahir') }}" required />
        </div>
      </div>

      <div class="field">
        <label for="password2">Konfirmasi Password</label>
        <div class="control">
          <input id="password2" name="password_confirmation" type="password" minlength="6" required />
          <button class="eye-btn" type="button" aria-label="Tampilkan password" data-toggle="password" data-target="#password2">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="field">
        <label for="tgl_lahir">Tanggal Lahir</label>
        <div class="control">
          <input id="tgl_lahir" name="tanggal_lahir" type="date" placeholder="dd/mm/yyyy" value="{{ old('tanggal_lahir') }}" required />
          <button class="calendar-btn" type="button" aria-label="Buka kalender" onclick="document.querySelector('#tgl_lahir').showPicker?.()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2"/>
              <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="actions">
        <button class="btn" href="{{ route('pengadu.login') }}">Sign Up</button>
      </div>
    </form>
  </main>

  {{-- Load JS --}}
  <script src="{{ asset('js/pengadu/register.js') }}"></script>
</body>
</html>
