<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    public $timestamps = false;
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rm';
    protected $fillable = ['id_pasien', 'keluhan', 'nama_dokter', 'diagnosa', 'tgl_periksa'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }
}
