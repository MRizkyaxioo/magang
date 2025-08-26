@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Hasil Pengaduan</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-3">Informasi Pengaduan</h4>
            <p><strong>Kategori:</strong> {{ $hasil->pengaduan->kategori ?? '-' }}</p>
            <p><strong>Lokasi Kejadian:</strong> {{ $hasil->lokasi_kejadian }}</p>
            <p><strong>Tanggal Kejadian:</strong> {{ $hasil->tanggal_kejadian }}</p>
            <p><strong>Deskripsi:</strong> {{ $hasil->deskripsi }}</p>
            <p><strong>Status:</strong> {{ $hasil->status }}</p>
            <p>
                <strong>Bukti Foto:</strong><br>
                @if($hasil->bukti_foto)
                    <img src="{{ asset('storage/'.$hasil->bukti_foto) }}" alt="Bukti Foto" width="200">
                @else
                    Tidak ada
                @endif
            </p>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Detail Pengadu</h4>
            <p><strong>NIK:</strong> {{ $hasil->pengadu->nik ?? '-' }}</p>
            <p><strong>Nama:</strong> {{ $hasil->pengadu->nama_pengadu ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $hasil->pengadu->alamat ?? '-' }}</p>
            <p><strong>Tempat Lahir:</strong> {{ $hasil->pengadu->tempat_lahir ?? '-' }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $hasil->pengadu->tanggal_lahir ?? '-' }}</p>
            <p><strong>No. Telepon:</strong> {{ $hasil->pengadu->no_telp ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $hasil->pengadu->email ?? '-' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
