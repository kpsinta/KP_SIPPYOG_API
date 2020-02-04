<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    //
    use SoftDeletes;
    protected $table = 'pegawais';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'id_role_fk',
        'nama_pegawai',
        'nip_pegawai',
        'username_pegawai',
        'password_pegawai'
    ];
    public function role(){
        return $this->belongsTo('App\Role', 'id_role_fk', 'id_role')->withTrashed();
    }

    public function pegawai_onduty(){
        return $this->hasMany('App\Pegawai_OnDuty','id_pegawai_fk', 'id_pegawai');
    }
}
