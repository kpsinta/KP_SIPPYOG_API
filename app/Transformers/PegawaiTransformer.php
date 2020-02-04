<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Pegawai;

class PegawaiTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Pegawai $pegawai)
    {
        return [
            'id_pegawai' => $pegawai->id_pegawai,
            'nama_pegawai' => $pegawai->nama_pegawai,
            'nip_pegawai'  => $pegawai->nip_pegawai,
            'username_pegawai' => $pegawai->username_pegawai,
            'password_pegawai' => $pegawai->password_pegawai,
            'id_role_fk' => $pegawai->id_role_fk,
            'nama_role' => $pegawai->role->nama_role,
            'created_at' => $pegawai->created_at,
            'updated_at' => $pegawai->updated_at,
            'deleted_at' => $pegawai->deleted_at,
        ];
    }
}