<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tiket extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tikets';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_tiket';
    protected $fillable = [
        'kode_tiket',
        'waktu_masuk',
        'waktu_keluar',
        'no_plat',
        'status_parkir',
        'status_tiket'
    ];
    public function kendaraan(){
        return $this->belongsTo('App\Kendaraan', 'id_kendaraan_fk', 'id_kendaraan')->withTrashed();
    }

    public function pegawai_onduty(){
        return $this->hasMany('App\Pegawai_OnDuty', 'id_tiket_fk','id_tiket');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Transaksi');
    }
}
