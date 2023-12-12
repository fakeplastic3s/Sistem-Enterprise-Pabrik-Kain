<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPengirimanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jadwal_pengiriman';
    protected $primaryKey       = 'id_pengirim';
    protected $allowedFields    = ['id_pengirim', 'nama_pengirim', 'tanggal_pengiriman', 'alamat_tujuan', 'id_barang', 'plat_nomor', 'jumlah_pengiriman', 'status'];


    public function getJadwalPengiriman($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_pengirim' => $id]);
        }
    }

    public function getJadwalPengirimanJoin($id = false)
    {
        return $this->table('jadwalpengiriman')
            ->join('stok_barang_jadi', 'stok_barang_jadi.id_barang = jadwal_pengiriman.id_barang')
            ->join('armada', 'armada.plat_nomor = jadwal_pengiriman.plat_nomor')
            ->groupBy('jadwal_pengiriman.id_pengirim')
            ->orderBy('jadwal_pengiriman.tanggal_pengiriman', 'ASC')
            ->get()->getResultArray();
    }


    public function hapusJadwalPengiriman($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pengirim' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('jadwal_pengiriman')->like('nama_barang', $keyword)->orLike('nama_kendaraan', $keyword)->orLike('tanggal_pengiriman', $keyword)->orLike('jumlah_pengiriman', $keyword);
    }
}
