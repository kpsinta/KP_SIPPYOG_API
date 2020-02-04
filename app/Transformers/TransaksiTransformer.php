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
            'biaya_parkir' => $transaksi->tiket->kendaraan->biaya_parkir,
            'biaya_denda' => $transaksi->tiket->kendaraan->biaya_denda,
            'id_kendaraan_fk' => $transaksi->tiket->id_kendaraan_fk,
            'jenis_kendaraan' => $transaksi->tiket->kendaraan->jenis_kendaraan,
            'kode_tiket'  => $transaksi->tiket->kode_tiket,
            'waktu_masuk' => $transaksi->tiket->waktu_masuk,
            'waktu_keluar' => $transaksi->tiket->waktu_keluar,
            'no_plat' => $transaksi->tiket->no_plat,
            'status_parkir' => $transaksi->tiket->status_parkir,
            'status_tiket' => $transaksi->tiket->status_tiket,
            'created_at' => $transaksi->created_at,
            'updated_at' => $transaksi->updated_at,
            'deleted_at' => $transaksi->deleted_at,
        ];
    }
}