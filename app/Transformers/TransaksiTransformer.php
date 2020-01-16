<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Transaksi;

class TransaksiTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Transaksi $transaksi)
    {
        return [
            'id_transaksi' => $transaksi->id_transaksi,
            'waktu_transaksi' => $transaksi->waktu_transaksi,
            'total_transaksi' => $transaksi->total_transaksi,
            'id_tiket_fk' => $transaksi->id_tiket_fk,
            'jenis_kendaraan' => $transaksi->tiket->kendaraan->jenis_kendaraan,
            'kode_tiket'  => $transaksi->tiket->kode_tiket,
            'waktu_masuk' => $transaksi->tiket->waktu_masuk,
            'waktu_keluar' => $transaksi->tiket->waktu_keluar,
            'no_plat' => $transaksi->tiket->no_plat,
            'status_parkir' => $transaksi->tiket->status_parkir,
            'status_tiket' => $transaksi->tiket->status_tiket,
        ];
    }
}