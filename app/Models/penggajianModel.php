<?php

namespace App\Models;

use CodeIgniter\Model;

class penggajianModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penggajian';
    protected $primaryKey       = 'id_penggajian';
    protected $allowedFields    = ['id_penggajian', 'id_pegawai', 'tgl_penggajian'];


    public function getpenggajian($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_pegawai' => $id]);
        }
    }
    public function getpenggajianJoin()
    {
        return $this->table('penggajian')
            ->join('pegawai', 'pegawai.id_pegawai = penggajian.id_pegawai')
            ->orderBy('penggajian.id_pegawai', 'ASC')
            ->get()->getResultArray();
    }

    public function countIzin()
    {
        $builder = $this->db->table('absensi');
        $builder->select('id_pegawai, status, COUNT(*) as izin');
        $builder->where('status', 'izin');
        $builder->groupBy('absensi.id_pegawai');
        // $builder->orderBy('absensi.id_pegawai');
        $query = $builder->get();
        return $query->getResultArray();
    }




    public function hapuspenggajian($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pegawai' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('penggajian')->like('nama_pegawai', $keyword)->orLike('alamat_pegawai', $keyword);
    }
}
