<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengurus extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengurus';
    protected $primaryKey = 'id_pengurus';

    protected $fillable = [
        'id_pengaduan',
        'instansi_pemerintahan',
        'email',
        'password',
    ];

     protected $hidden = [
        'password',
    ];

    // Relasi ke hasil_pengaduan
    public function hasilPengaduan()
    {
        return $this->belongsTo(HasilPengaduan::class, 'id_hasil', 'id_hasil');
    }

    // Relasi ke pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }
}
