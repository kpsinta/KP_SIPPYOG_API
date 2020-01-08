<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_role';
    protected $fillable = [
        'nama_role'
    ];
    public function pegawai(){
        return $this->hasMany('App\Pegawai', 'id_role_fk' , 'id_role');
    }
}
