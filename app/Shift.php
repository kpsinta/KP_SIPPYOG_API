<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    //
    use SoftDeletes;
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
