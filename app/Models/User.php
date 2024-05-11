<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users'; // Pastikan ini sesuai dengan nama tabel di database

    protected $primaryKey = 'id_user'; // Sesuaikan primary key

    protected $fillable = ['username', 'email', 'password']; // Sesuaikan dengan kolom yang diizinkan untuk mass assignment

    // Jika Anda menggunakan fitur autentikasi, Anda mungkin juga ingin menambahkan:
    protected $hidden = [
        'password', // Sembunyikan password dalam array/json
    ];
}

