<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'supplier';
    protected $primaryKey       = 'id_supplier';
    protected $allowedFields    = ['id_supplier', 'nama_supplier', 'alamat', 'nama_barang', 'harga_satuan'];


    public function getSupplier($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_supplier' => $id]);
        }
    }


    public function hapusSupplier($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_supplier' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('Supplier')->like('nama_supplier', $keyword)->orLike('nama_barang', $keyword);
    }

    public function countSupplier()
    {
        return $this->table('supplier')
            ->selectcount('id_supplier')
            ->get()->getRow();
    }
}
