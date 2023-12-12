<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanMasukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bahan_masuk';
    protected $primaryKey       = 'id_bahan_masuk';
    protected $allowedFields    = ['id_bahan_masuk', 'id_bahan_mentah', 'nama_bahan_masuk', 'id_supplier', 'tanggal_masuk', 'jumlah'];


    public function getBahanMasuk($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_bahan_masuk' => $id]);
        }
    }

    public function getBahanMasukJoin($id = false)
    {
        return $this->table('bahan_masuk')
            ->join('supplier', 'supplier.id_supplier = bahan_masuk.id_supplier')
            ->groupBy('bahan_masuk.id_bahan_masuk')
            ->orderBy('bahan_masuk.tanggal_masuk', 'ASC')
            ->get()->getResultArray();
    }
    public function laporanperBulan()
    {
        return $this->table('bahan_masuk')
            ->join('supplier', 'supplier.id_supplier = bahan_masuk.id_supplier')
            ->groupBy('MONTH(tanggal_masuk)')
            ->select('MONTH(tanggal_masuk) AS bulan,SUM(jumlah) AS total')
            ->get()->getResultArray();
    }


    public function hapusBahanMasuk($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_bahan_masuk' => $id]);
    }

    public function lastDate()
    {
        return $this->table('bahan_masuk')
            ->selectMax('tanggal_masuk')
            ->get()->getRow();
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('bahan_masuk')->like('nama_bahan_masuk', $keyword)->orLike('tanggal_masuk', $keyword)->orLike('jumlah', $keyword)->orLike('nama_supplier', $keyword);
    }
}
