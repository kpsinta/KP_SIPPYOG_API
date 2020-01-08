<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    //
    protected $table = 'shifts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_shift';
    protected $fillable = [
        'nama_shift',
        'jam_masuk',
        'jam_keluar'
    ];

    public function pegawai_onduty(){
        return $this->hasMany('App\Pegawai_OnDuty', 'id_shift_fk', 'id_shift');
    }
}
