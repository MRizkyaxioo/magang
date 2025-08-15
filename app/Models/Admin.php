<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable

{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'id_hasil',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

}
