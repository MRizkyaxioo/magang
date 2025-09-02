@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Hasil Pengaduan</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-3">Informasi Pengaduan</h4>
            <p><strong>Kategori:</strong> {{ $hasilPengaduan->pengaduan->kategori ?? '-' }}</p>
            <p><strong>Lokasi Kejadian:</strong> {{ $hasilPengaduan->lokasi_kejadian }}</p>
            <p><strong>Tanggal Kejadian:</strong> {{ $hasilPengaduan->tanggal_kejadian }}</p>
            <p><strong>Status:</strong> {{ ucfirst($hasilPengaduan->status) }}</p>
            <p><strong>Deskripsi:</strong> {{ $hasilPengaduan->deskripsi }}</p>

            @if($hasilPengaduan->bukti_foto)
                <p><strong>Bukti Foto:</strong></p>
                <img src="{{ asset('storage/'.$hasilPengaduan->bukti_foto) }}"
                     alt="Bukti Foto"
                     style="max-width: 200px; border-radius: 8px;">
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Informasi Pengadu</h4>
            <p><strong>NIK:</strong> {{ $hasilPengaduan->pengadu->nik }}</p>
            <p><strong>Nama:</strong> {{ $hasilPengaduan->pengadu->nama_pengadu }}</p>
            <p><strong>Alamat:</strong> {{ $hasilPengaduan->pengadu->alamat }}</p>
            <p><strong>Tempat Lahir:</strong> {{ $hasilPengaduan->pengadu->tempat_lahir }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $hasilPengaduan->pengadu->tanggal_lahir }}</p>
            <p><strong>No. Telp:</strong> {{ $hasilPengaduan->pengadu->no_telp }}</p>
            <p><strong>Email:</strong> {{ $hasilPengaduan->pengadu->email }}</p>
        </div>
    </div>

    <a href="{{ route('pengurus.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
