<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Tiket;

class TiketTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Tiket $tiket)
    {
        return [
            'id_tiket' => $tiket->id_tiket,
            'biaya_parkir'=> $tiket->kendaraan->biaya_parkir,
            'biaya_denda'=> $tiket->kendaraan->biaya_denda,
            'id_kendaraan_fk' => $tiket->id_kendaraan_fk,
            'jenis_kendaraan' => $tiket->kendaraan->jenis_kendaraan,
            'kode_tiket'  => $tiket->kode_tiket,
            'waktu_masuk' => $tiket->waktu_masuk,
            'waktu_keluar' => $tiket->waktu_keluar,
            'no_plat' => $tiket->no_plat,
            'status_parkir' => $tiket->status_parkir,
            'status_tiket' => $tiket->status_tiket,
            'created_at' => $tiket->created_at,
            'updated_at' => $tiket->updated_at,
            'deleted_at' => $tiket->deleted_at,
        ];
    }
}