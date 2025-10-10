<?php

namespace App\Models;

use App\Models\Pengadu;
use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HasilPengaduan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'hasil_pengaduan';
    protected $primaryKey = 'id_hasil';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pengadu',
        'id_pengaduan',
        'lokasi_kejadian',
        'latitude',        // TAMBAHKAN INI
        'longitude',       // TAMBAHKAN INI
        'tanggal_kejadian',
        'bukti_foto',
        'status',
        'keterangan',
        'deskripsi',
    ];

    // Relasi ke admin
    public function admin()
    {
        return $this->hasMany(Admin::class, 'id_hasil', 'id_hasil');
    }

    // Relasi ke pengadu
    public function pengadu()
    {
        return $this->belongsTo(Pengadu::class, 'id_pengadu', 'id_pengadu');
    }

    // Relasi ke pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    // Relasi ke pengurus
    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class, 'id_pengaduan', 'id_pengaduan');
    }
}
