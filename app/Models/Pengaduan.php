<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pengaduan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kategori',
        'deskripsi_pengaduan',
        'foto_illustrasi',
    ];

    // Relasi ke hasil_pengaduan
    public function hasilPengaduan()
    {
        return $this->hasMany(HasilPengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }
}
