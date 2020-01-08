<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai_OnDuty extends Model
{
     //
     protected $table = 'pegawai_on_duties';      //mendefine tabel yang digunakan
     protected $primaryKey = 'id_pegawaiOnDuty';
     protected $fillable = [
        'id_shift_fk',
        'id_pegawai_fk',
        'id_tiket_fk',
        'id_transaksi_fk'
    ];

    public function shift(){
        return $this->belongsTo('App\Shift', 'id_shift_fk', 'id_shift');
    }

     public function pegawai(){
         return $this->belongsTo('App\Pegawai', 'id_pegawai_fk', 'id_pegawai');
     }

     public function tiket(){
        return $this->belongsTo('App\Tiket', 'id_tiket_fk', 'id_tiket');
    }

    public function transaksi(){
        return $this->belongsTo('App\Transaksi', 'id_transaksi_fk', 'id_transaksi');
    }

}
