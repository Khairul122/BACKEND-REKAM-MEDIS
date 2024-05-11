<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    public $timestamps = false;

    protected $fillable = ['nama_obat', 'ket_obat'];

    protected $primaryKey = 'id_obat'; 
}
