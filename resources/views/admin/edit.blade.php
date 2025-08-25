@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Kategori Pengaduan</h2>
    <form action="{{ route('kategori.update', $pengaduan->id_pengaduan) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $pengaduan->kategori }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi_pengaduan" class="form-control" required>{{ $pengaduan->deskripsi_pengaduan }}</textarea>
        </div>
        <div class="mb-3">
            <label>Foto Illustrasi (opsional)</label>
            <input type="file" name="foto_illustrasi" class="form-control">
            @if($pengaduan->foto_illustrasi)
                <img src="{{ asset('storage/'.$pengaduan->foto_illustrasi) }}" width="80" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
