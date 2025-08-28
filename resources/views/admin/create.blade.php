@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Akun Pengurus</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengurus.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Instansi</label>
            <input type="text" name="instansi_pemerintahan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Pengurus</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori Pengaduan</label>
            <select name="id_pengaduan" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id_pengaduan }}">{{ $k->kategori }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Buat Akun</button>
        <a href="{{ route('pengurus.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
