<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratRujukan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'surat_rujukan';
    protected $primaryKey = 'id_surat_rujukan';
    protected $fillable = [
        'nomor_surat',
        'tgl_surat',
        'id_pasien',
        'nama_pasien',
        'usia_pasien',
        'jenis_kelamin',
        'alamat',
        'diagnosis',
        'dokter_pengirim',
        'catatan'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }
}

