<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $allowedFields    = ['id_penjualan', 'id_barang', 'id_sales', 'tanggal_penjualan', 'jumlah_penjualan'];


    public function getPenjualan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_penjualan' => $id]);
        }
    }

    public function getPenjualanJoin($id = false)
    {
        return $this->table('penjualan')
            ->join('stok_barang_jadi', 'stok_barang_jadi.id_barang = penjualan.id_barang')
            ->join('sales_marketing', 'sales_marketing.id_sales = penjualan.id_sales')
            ->groupBy('penjualan.id_penjualan')
            ->orderBy('penjualan.tanggal_penjualan', 'ASC')
            ->get()->getResultArray();
    }


    public function hapusPenjualan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_penjualan' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('penjualan')->like('nama_barang', $keyword)->orLike('nama_sales', $keyword)->orLike('tanggal_penjualan', $keyword)->orLike('jumlah_penjualan', $keyword);
    }

    public function sumPenjualan()
    {
        return $this->table('penjualan')
            ->join('stok_barang_jadi', 'stok_barang_jadi.id_barang = penjualan.id_barang')
            ->select('SUM(penjualan.jumlah_penjualan * stok_barang_jadi.harga) AS total')
            ->get()->getRow();
    }

    public function laporanPerPeriode($tglawal, $tglakhir)
    {
        return $this->table('penjualan')
            ->join('sales_marketing', 'sales_marketing.id_sales = penjualan.id_sales')
            ->join('stok_barang_jadi', 'stok_barang_jadi.id_barang = penjualan.id_barang')
            ->where('tanggal_penjualan >=', $tglawal)
            ->where('tanggal_penjualan <=', $tglakhir)
            ->get();
    }
}
