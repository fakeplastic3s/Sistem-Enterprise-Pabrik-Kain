<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPerawatanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jadwal_perawatan';
    protected $primaryKey       = 'id_perawatan';
    protected $allowedFields    = ['id_perawatan', 'id_mesin', 'tanggal_perawatan', 'status'];


    public function getJadwalPerawatan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_perawatan' => $id]);
        }
    }

    public function getJadwalPerawatanJoin($id = false)
    {
        return $this->table('jadwal_perawatan')
            ->join('aset_mesin', 'aset_mesin.id_mesin = jadwal_perawatan.id_mesin')
            ->get()->getResultArray();
    }


    public function hapusJadwalPerawatan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_perawatan' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        // return $this->table('jadwal_perawatan')->like('nama_barang', $keyword)->orLike('tanggal_', $keyword)->orLike('jumlah', $keyword)->orLike('nama_supplier', $keyword);
        return $this->table('jadwal_perawatan')
            ->join('aset_mesin', 'aset_mesin.id_mesin = jadwal_perawatan.id_mesin')
            ->like('nama_mesin', $keyword)->orLike('tanggal_perawatan', $keyword);
    }
}
