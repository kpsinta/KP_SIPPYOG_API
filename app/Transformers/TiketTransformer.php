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
            'jenis_kendaraan' => $tiket->kendaraan->jenis_kendaraan,
            'kode_tiket'  => $tiket->kode_tiket,
            'waktu_masuk' => $tiket->waktu_masuk,
            'waktu_keluar' => $tiket->waktu_keluar,
            'no_plat' => $tiket->no_plat,
            'status_tiket' => $tiket->status_tiket,
        ];
    }
}