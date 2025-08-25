<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --yellow: #ffeb13;
      --text: #1b1b1b;
      --border: #1c1c1c;
      --radius: 18px;
      --shadow: 0 10px 0 rgba(0,0,0,.18);
    }
    *{ box-sizing: border-box; }
    body{
      margin:0;
      min-height:100vh;
      display:grid;
      place-items:center;
      background:#fffef2;
      font-family:Poppins, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color:var(--text);
    }

    .card{
      width:min(1100px, 92vw);
      background:var(--yellow);
      border:2.5px solid var(--border);
      border-radius:32px;
      padding:38px 42px 46px;
      box-shadow: 0 6px 0 rgba(0,0,0,.18) inset;
      position:relative;
    }
    h1{
      text-align:center;
      margin:0 0 26px;
      font-weight:800;
      letter-spacing:.5px;
      text-shadow: 0 2px 0 rgba(0,0,0,.18);
    }

    form{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:20px 44px;
      margin-top:10px;
    }

    .field{
      display:flex;
      flex-direction:column;
      gap:8px;
    }
    label{
      font-size:16px;
      font-weight:600;
    }

    .control{
      position:relative;
    }

    input, textarea{
      width:100%;
      font: 16px/1.2 Poppins, sans-serif;
      color:var(--text);
      background:#fff;
      border:2.5px solid var(--border);
      border-radius:12px;
      padding:14px 16px;
      outline:none;
      transition:border-color .15s ease;
      box-shadow: 0 3px 0 rgba(0,0,0,.18);
    }
    textarea{ min-height:110px; resize:vertical; }

    input:focus, textarea:focus{
      border-color:#000;
    }

    .eye-btn, .calendar-btn{
      position:absolute;
      right:12px;
      top:50%;
      transform:translateY(-50%);
      width:38px;
      height:38px;
      display:grid;
      place-items:center;
      border:2px solid var(--border);
      border-radius:10px;
      background:#fff;
      cursor:pointer;
      box-shadow: 0 2px 0 rgba(0,0,0,.18);
    }
    .eye-btn svg, .calendar-btn svg{ width:22px; height:22px; }

    /* Tombol submit */
    .actions{
      grid-column: 1 / -1;
      display:flex;
      justify-content:center;
      margin-top:8px;
    }
    .btn{
      font-weight:800;
      font-size:24px;
      padding:18px 42px;
      border-radius:18px;
      background:#ffd800;
      border:3px solid var(--border);
      cursor:pointer;
      box-shadow: var(--shadow);
      transition: transform .06s ease;
    }
    .btn:active{ transform: translateY(2px); }

    /* Responsif */
    @media (max-width: 900px){
      form{ grid-template-columns: 1fr; }
      .actions{ margin-top:10px; }
    }

    /* Placeholder custom untuk input date */
    input[type="date"]:not(:focus):invalid::before {
      content: attr(placeholder);
      color: #888;
    }
    input[type="date"]::before {
      position: absolute;
      left: 16px;
    }

    /* Sembunyikan default "dd/mm/yyyy" bawaan browser (agar tidak dobel) */
    input[type="date"]:required:invalid::-webkit-datetime-edit{
      color: transparent;
    }
    input[type="date"]::-webkit-calendar-picker-indicator{
      opacity:0; /* pakai tombol ikon sendiri */
    }
    input[type="date"]:focus::-webkit-datetime-edit{
      color: inherit;
    }
  </style>
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
            <!-- eye icon -->
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
            <!-- calendar icon -->
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

  <script>
    // Toggle show/hide password
    document.querySelectorAll('[data-toggle="password"]').forEach(btn=>{
      btn.addEventListener('click', ()=>{
        const target = document.querySelector(btn.dataset.target);
        const isPwd = target.type === 'password';
        target.type = isPwd ? 'text' : 'password';
        btn.classList.toggle('on', isPwd);
      });
    });

    // Batasi NIK hanya angka
    const nik = document.getElementById('nik');
    nik.addEventListener('input', e=>{
      e.target.value = e.target.value.replace(/\D/g,'').slice(0,16);
    });
  </script>
</body>
</html>
