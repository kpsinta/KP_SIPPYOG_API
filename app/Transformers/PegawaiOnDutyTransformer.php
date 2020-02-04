<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Pegawai_OnDuty;

class PegawaiOnDutyTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Pegawai_OnDuty $pegawaionduty)
    {
        return [
            'id_pegawaiOnDuty' => $pegawaionduty->id_pegawaiOnDuty,
            'id_shift_fk' => $pegawaionduty->id_shift_fk,
            'id_pegawai_fk'  => $pegawaionduty->id_pegawai_fk,
            'id_tiket_fk' => $pegawaionduty->id_tiket_fk,
            'id_transaksi_fk' => $pegawaionduty->id_transaksi_fk,
            'nama_pegawai' => $pegawaionduty->pegawai->nama_pegawai,
            'nama_shift' => $pegawaionduty->shift->nama_shift,
            'created_at' => $pegawaionduty->created_at,
            'updated_at' => $pegawaionduty->updated_at,
            'deleted_at' => $pegawaionduty->deleted_at,
        ];
    }
}