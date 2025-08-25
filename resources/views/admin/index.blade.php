@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Kategori Pengaduan</h2>

    <!-- Tombol untuk memunculkan modal Tambah -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#kategoriModal">
        Tambah Kategori
    </button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $item)
                <tr>
                    <td>{{ $item->kategori }}</td>
                    <td>
                        <!-- Tombol Edit (trigger modal) -->
                        <button type="button" class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editKategoriModal{{ $item->id_pengaduan }}">
                            Edit
                        </button>

                        <!-- Form Hapus -->
                        <form action="{{ route('pengaduan.destroy', $item->id_pengaduan) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editKategoriModal{{ $item->id_pengaduan }}" tabindex="-1" aria-labelledby="editKategoriLabel{{ $item->id_pengaduan }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editKategoriLabel{{ $item->id_pengaduan }}">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('pengaduan.update', $item->id_pengaduan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Nama Kategori</label>
                                <input type="text" name="kategori" class="form-control" value="{{ $item->kategori }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Belum ada kategori</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('pengaduan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kategori" class="form-label">Nama Kategori</label>
                <input type="text" name="kategori" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
