<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalProduksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jadwal_produksi';
    protected $primaryKey       = 'id_produksi';
    protected $allowedFields    = ['id_produksi', 'id_kebutuhan_produksi', 'tanggal_produksi', 'jam_produksi'];


    public function getJadwalProduksi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_produksi' => $id]);
        }
    }

    public function getJadwalProduksiJoin($id = false)
    {
        return $this->table('jadwal_produksi')
            ->join('kebutuhan_produksi', 'kebutuhan_produksi.id_kebutuhan_produksi = jadwal_produksi.id_kebutuhan_produksi')
            ->get()->getResultArray();
    }



    public function hapusJadwalProduksi($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_produksi' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        // return $this->table('jadwal_produksi')->like('nama_barang', $keyword)->orLike('tanggal_', $keyword)->orLike('jumlah', $keyword)->orLike('nama_supplier', $keyword);
        return $this->table('jadwal_produksi')
            ->join('stok_barang_jadi', 'stok_barang_jadi.id_barang = jadwal_produksi.id_barang')
            ->like('nama_barang', $keyword)->orLike('tanggal_', $keyword)->orLike('jumlah', $keyword)->orLike('nama_supplier', $keyword);
    }
}
