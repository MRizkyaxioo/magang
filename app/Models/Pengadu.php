<?php

namespace App\Models;

use App\Models\HasilPengaduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengadu extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengadu';
    protected $primaryKey = 'id_pengadu';

    protected $fillable = [
        'nik',
        'nama_pengadu',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function hasilPengaduan()
{
    return $this->hasMany(hasilPengaduan::class, 'id_pengadu', 'id_pengadu');
}

}
