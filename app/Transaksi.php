<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
     //
     use SoftDeletes;
     protected $table = 'transaksis';      //mendefine tabel yang digunakan
     protected $primaryKey = 'id_transaksi';
     protected $fillable = [
        'id_tiket_fk',
        'waktu_transaksi',
        'total_transaksi'
    ];

     public function pegawai_onduty(){
        return $this->hasMany('App\Pegawai_OnDuty', 'id_transaksi_fk','id_transaksi');
    }

    public function tiket()
    {
        return $this->belongsTo('App\Tiket', 'id_tiket_fk', 'id_tiket')->withTrashed();
    }
}
