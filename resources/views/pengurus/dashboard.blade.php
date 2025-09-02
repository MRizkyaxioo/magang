 <h4>Selamat Datang, {{ Auth::guard('pengurus')->user()->instansi_pemerintahan }} 🎉</h4>
 <form method="POST" action="{{ route('pengurus.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Lokasi</th>
        <th>Deskripsi</th>
        <th>Tanggal</th>
        <th>Bukti Foto</th>
        <th>Status</th>
        <th>Aksi</th>
        <th>Detail</th>
    </tr>
    @foreach($hasilPengaduan as $pengaduan)
    <tr>
        <td>{{ $pengaduan->id_hasil }}</td>
        <td>{{ $pengaduan->lokasi_kejadian }}</td>
        <td>{{ $pengaduan->deskripsi }}</td>
        <td>{{ $pengaduan->tanggal_kejadian }}</td>
        <td>
        <img src="{{ asset('storage/'.$pengaduan->bukti_foto) }}"
         alt="Bukti Foto Pengaduan"
         style="max-width: 100px; height: auto; border-radius: 5px;">
        </td>
        <td>{{ $pengaduan->status }}</td>
        <td>
<form action="{{ route('pengurus.updateStatus', $pengaduan->id_hasil) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="status" class="form-control">
        <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="sedang dikerjakan" {{ $pengaduan->status == 'sedang dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>

    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>

        </td>
        <td>
                    <a href="{{ route('pengurus.show', $pengaduan->id_hasil) }}" class="detail-btn">
                        <span>👁️</span>
                        Lihat Detail
                    </a>
        </td>
    </tr>
    @endforeach
</table>
