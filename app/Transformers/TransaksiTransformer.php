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
        ];
    }
}