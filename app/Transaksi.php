<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     //
     protected $table = 'transaksis';      //mendefine tabel yang digunakan
     protected $primaryKey = 'id_transaksi';
     protected $fillable = [
        'waktu_transaksi',
        'total_transaksi'
    ];

     public function pegawai_onduty(){
        return $this->hasMany('App\Pegawai_OnDuty', 'id_transaksi_fk','id_transaksi');
    }
}
