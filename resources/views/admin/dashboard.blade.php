@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Hasil Pengaduan</h2>
    <a href="{{ route('pengaduan.index') }}" class="btn btn-primary mb-3">Kelola Kategori Pengaduan</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Pengadu</th>
                <th>Kategori</th>
                <th>Lokasi Kejadian</th>
                <th>Tanggal Kejadian</th>
                <th>Deskripsi</th>
                <th>Bukti Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $item)
            <tr>
                <td>{{ $item->pengadu->nama_pengadu ?? '-' }}</td>
                <td>{{ $item->pengaduan->kategori ?? '-' }}</td>
                <td>{{ $item->lokasi_kejadian }}</td>
                <td>{{ $item->tanggal_kejadian }}</td>
                <td>{{ $item->deskripsi }}</td>
               <td>
                @if($item->bukti_foto)
                  <img src="{{ asset('storage/'.$item->bukti_foto) }}" alt="Bukti Foto" width="120">
                @else
                  <span class="text-muted">Tidak ada foto</span>
                @endif
              </td>
                <td>
                    <form action="{{ route('admin.updateStatus', $item->id_hasil) }}" method="POST">
                        @csrf
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="sedang dikerjakan" {{ $item->status == 'sedang dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="{{ route('admin.show', $item->id_hasil) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
