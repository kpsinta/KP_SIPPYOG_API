<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Kendaraan;

class KendaraanTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Kendaraan $k)
    {
        return [
            'id_kendaraan' => $k->id_kendaraan,
            'jenis_kendaraan' => $k->jenis_kendaraan,
            'kapasitas_maksimum'  => $k->kapasitas_maksimum,
            'biaya_parkir' => $k->biaya_parkir,
            'biaya_denda' => $k->biaya_denda,
        ];
    }
}