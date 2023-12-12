<?php

namespace App\Models;

use CodeIgniter\Model;

class KebutuhanProduksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kebutuhan_produksi';
    protected $primaryKey       = 'id_kebutuhan_produksi';
    protected $allowedFields    = ['id_kebutuhan_produksi', 'kebutuhan_produksi', 'nama_barang', 'bahan',];


    public function getKebutuhanProduksi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_kebutuhan_produksi' => $id]);
        }
    }



    public function hapuKebutuhanProduksi($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_kebutuhan_produksi' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        // return $this->table('jadwal_produksi')->like('nama_barang', $keyword)->orLike('tanggal_', $keyword)->orLike('jumlah', $keyword)->orLike('nama_supplier', $keyword);
        return $this->table('kebutuhan_produksi')
            ->like('nama_barang', $keyword)->orLike('bahan', $keyword);
    }
}
