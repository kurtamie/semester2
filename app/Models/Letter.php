<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    // STATU S=array('PROSES','SELESAI','DITOLAK');
    use HasFactory;

    protected $table = 'letters';

    protected $primaryKey = 'id_surat_izin';

    protected $fillable =  array (
        'id_user', 'nim', 'nama', 'nama_dosen_wali', 'kelas_perkuliahan', 'nama_dan_nomor_telepon_orang_tua_wali',
        'tanggal_mulai_izin','jenis_perizinan', 'tanggal_akhir_izin', 'status', 'foto1','foto2','foto3'
    );
}
