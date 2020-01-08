<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Shift;

class ShiftTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Shift $shift)
    {
        return [
            'id_shift' => $shift->id_shift,
            'nama_shift' => $shift->nama_shift,
            'jam_masuk'  => $shift->jam_masuk,
            'jam_keluar' => $shift->jam_keluar,
        ];
    }
}