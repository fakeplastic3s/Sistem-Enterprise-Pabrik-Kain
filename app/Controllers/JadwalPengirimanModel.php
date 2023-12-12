<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPengirimanModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'jadwal_pengiriman';
    protected $primaryKey = 'id_pengirim';
    protected $allowedFields = ['id_pengirim', 'nama_pengirim', 'tanggal_pengiriman', 'alamat_tujuan', 'id_barang', 'jumlah_pengiriman', 'plat_nomor', 'status'];


    public function getJadwalPengiriman($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_pengirim' => $id])->getRowArray();
        }
    }
    public function getJadwalPengirimanJoin($id = false)
    {
        return $this->table('jadwal_pengiriman')
            ->join('stok_barang_jadi', 'stok_barang_jadi.id_barang = jadwal_pengiriman.id_barang')
            ->join('armada', 'armada.plat_nomor = jadwal_pengiriman.plat_nomor')
            ->groupBy('jadwal_pengiriman.id_pengirim')
            ->orderBy('jadwal_pengiriman.tanggal_pengiriman', 'ASC')
            ->get()->getResultArray();
    }


    public function hapusJadwalPengirirman($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pengirim' => $id]);
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
    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        // return $this->table('jadwal_pengiriman')->like('nama_pengirim', $keyword)->orLike('nama_barang', $keyword)->orLike('nama_barang', $keyword);
        return $this->table('jadwal_pengiriman')->like('nama_pengirim', $keyword)->orLike('nama_barang', $keyword);
    }
}
