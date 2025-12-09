<!DOCTYPE html>
<html>
<head>
    <title>Statistik Pengaduan</title>
    <style>
    body { font-family: sans-serif; }
    h2 { text-align: center; }

    table {
        margin-top: 30px;
        width: 100%;
        border-collapse: collapse;
    }

    td, th {
        border: 1px solid black;
        padding: 8px;
    }
</style>

</head>
<body>

<h2>Statistik Pengaduan Bulan {{ $bulanLabel }}</h2>

<table>
    <tr>
        <th>Status</th>
        <th>Jumlah</th>
    </tr>
    <tr><td>Pending</td><td>{{ $statistik['pending'] }}</td></tr>
    <tr><td>Sedang Dikerjakan</td><td>{{ $statistik['sedang'] }}</td></tr>
    <tr><td>Selesai</td><td>{{ $statistik['selesai'] }}</td></tr>
    <tr><td>Ditolak</td><td>{{ $statistik['ditolak'] }}</td></tr>
    <tr><th>Total</th><th>{{ $statistik['total'] }}</th></tr>
</table>

</body>
</html>
