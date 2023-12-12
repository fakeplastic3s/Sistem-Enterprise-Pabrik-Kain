<?php

namespace App\Models;

use CodeIgniter\Model;

class StokBarangJadiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'stok_barang_jadi';
    protected $primaryKey       = 'id_barang';
    protected $allowedFields    = ['id_barang', 'nama_barang', 'jumlah', 'harga', 'gambar'];


    public function getStokBarangJadi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_barang' => $id]);
        }
    }

    // public function getStokBarangJadiJoin($id = false)
    // {
    //     return $this->table('stok_barang_jadi')
    //         ->join('hasil_produksi', 'hasil_produksi.id_hasil_produksi = stok_barang_jadi.id_hasil_produksi')
    //         ->get()->getResultArray();
    // }


    public function hapusStokBarangJadi($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_barang' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('stok_barang_jadi')->like('nama_barang', $keyword);
    }
}
