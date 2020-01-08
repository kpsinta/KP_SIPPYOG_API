<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Role;

class RoleTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Role $role)
    {
        return [
            'id_role' => $role->id_role,
            'nama_role' => $role->nama_role,
        ];
    }
}