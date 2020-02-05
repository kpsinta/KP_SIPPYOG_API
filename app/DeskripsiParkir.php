<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeskripsiParkir extends Model
{
    //
    use SoftDeletes;
    protected $table = 'deskripsi_parkirs';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_deskripsi_parkir';
    protected $fillable = [
        'waktu_operasional',
        'alamat_tkp',
        'nomor_telepon',
        'deskripsi',
    ];
}
