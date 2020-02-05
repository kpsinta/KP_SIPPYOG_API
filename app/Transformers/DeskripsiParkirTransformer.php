<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\DeskripsiParkir;

class DeskripsiParkirTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(DeskripsiParkir $dp)
    {
        return [
            'id_deskripsi_parkir' => $dp->id_deskripsi_parkir,
            'waktu_operasional' => $dp->waktu_operasional,
            'alamat_tkp' => $dp->alamat_tkp,
            'nomor_telepon' => $dp->nomor_telepon,
            'deskripsi' => $dp->deskripsi,
            'created_at' => $dp->created_at,
            'updated_at' => $dp->updated_at,
            'deleted_at' => $dp->deleted_at,
        ];
    }
}