<!DOCTYPE html>
<html>
<head>
    <title>Statistik Pengaduan</title>
    <style>
    body { font-family: sans-serif; }
    h2 { text-align: center; }

    .bar-container { margin-top: 30px; }

    .bar {
        height: 25px;
        margin-bottom: 15px;
        color: white;
        padding-left: 10px;
        line-height: 25px;
    }

    .pending { background: orange; width: {{ $statistik['pending'] * 20 }}px; }
    .sedang  { background: blue;   width: {{ $statistik['sedang']  * 20 }}px; }
    .selesai { background: green;  width: {{ $statistik['selesai'] * 20 }}px; }
    .ditolak { background: red;    width: {{ $statistik['ditolak'] * 20 }}px; }

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

<div class="bar-container">
    <div class="bar pending">Pending: {{ $statistik['pending'] }}</div>
    <div class="bar sedang">Sedang Dikerjakan: {{ $statistik['sedang'] }}</div>
    <div class="bar selesai">Selesai: {{ $statistik['selesai'] }}</div>
    <div class="bar ditolak">Ditolak: {{ $statistik['ditolak'] }}</div>
</div>

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
