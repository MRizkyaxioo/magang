@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Kategori Pengaduan</h2>
    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi_pengaduan" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Foto Illustrasi (opsional)</label>
            <input type="file" name="foto_illustrasi" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
