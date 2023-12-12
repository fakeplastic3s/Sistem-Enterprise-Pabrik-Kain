<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilProduksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hasil_produksi';
    protected $primaryKey       = 'id_hasil_produksi';
    protected $allowedFields    = ['id_hasil_produksi', 'id_barang', 'tanggal_produksi', 'jumlah_hasil_produksi'];


    public function getHasilProduksi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_hasil_produksi' => $id]);
        }
    }

    public function getHasilProduksiJoin($id = false)
    {
        return $this->table('hasil_produksi')
            ->join('stok_barang_jadi', 'stok_barang_jadi.id_barang = hasil_produksi.id_barang')
            ->get()->getResultArray();
    }

    public function sumJumlahProduksi()
    {
        return $this->table('hasil_produksi')
            ->selectsum('jumlah_hasil_produksi')
            ->get()->getRow();
    }

    public function getNamaBarang()
    {
        $builder = $this->db->table('stok_barang_jadi');
        $builder->select('id_barang, nama_barang');
        $builder->groupBy('stok_barang_jadi.id_barang');
        $builder->orderBy('stok_barang_jadi.id_barang', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();

        // $builder = $this->db->table('stok_barang_jadi');
        // $builder->select('stok_barang_jadi.id_barang, hasil_produksi.nama_barang');
        // $builder->join('hasil_produksi', 'hasil_produksi.id_hasil_produksi = stok_barang_jadi.id_hasil_produksi');
        // $builder->groupBy('stok_barang_jadi.id_barang');
        // $builder->orderBy('stok_barang_jadi.id_barang', 'ASC');
        // $query = $builder->get();
        // return $query->getResultArray();
    }


    public function hapusHasilProduksi($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_hasil_produksi' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('HasilProduksi')->like('nama_barang', $keyword)->orLike('tanggal_produksi', $keyword);
    }
}
