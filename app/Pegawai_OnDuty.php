<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai_OnDuty extends Model
{
     //
     use SoftDeletes;
     protected $table = 'pegawai__on_duties';      //mendefine tabel yang digunakan
     protected $primaryKey = 'id_pegawaiOnDuty';
     protected $fillable = [
        'id_shift_fk',
        'id_pegawai_fk',
        'id_tiket_fk',
        'id_transaksi_fk'
    ];

    public function shift(){
        return $this->belongsTo('App\Shift', 'id_shift_fk', 'id_shift')->withTrashed();
    }

     public function pegawai(){
         return $this->belongsTo('App\Pegawai', 'id_pegawai_fk', 'id_pegawai')->withTrashed();
     }

     public function tiket(){
        return $this->belongsTo('App\Tiket', 'id_tiket_fk', 'id_tiket')->withTrashed();
    }

    public function transaksi(){
        return $this->belongsTo('App\Transaksi', 'id_transaksi_fk', 'id_transaksi')->withTrashed();
    }

}
