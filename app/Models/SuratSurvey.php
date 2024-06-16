<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratSurvey extends Model
{
    use HasFactory;
    protected $table = 'surat_surveys';
    protected $primaryKey = 'id_surat_survey';
    protected $fillable = array (
        'id_user','alamat_instansi', 'alamat_tujuan','keperluan_mahasiswa',
        'tugas_yang_dikerjakan','nim','nama','status','pdf_file',
    );
}
