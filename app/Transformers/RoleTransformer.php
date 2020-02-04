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
            'created_at' => $role->created_at,
            'updated_at' => $role->updated_at,
            'deleted_at' => $role->deleted_at,
        ];
    }
}