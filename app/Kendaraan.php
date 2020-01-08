<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
     //
     protected $table = 'kendaraans';      //mendefine tabel yang digunakan
     protected $primaryKey = 'id_kendaraan';
     protected $fillable = [
        'jenis_kendaraan',
        'kapasitas_maksimum',
        'biaya_parkir',
        'biaya_denda'
     ];
     public function tiket(){
        return $this->hasMany('App\Tiket', 'id_kendaraan_fk', 'id_kendaraan');
     }
}
