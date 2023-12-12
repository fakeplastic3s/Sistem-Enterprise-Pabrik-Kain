<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id_pegawai';
    protected $allowedFields    = ['id_pegawai', 'nama_pegawai', 'alamat', 'jabatan', 'gaji_pokok'];


    public function getPegawai($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_pegawai' => $id]);
        }
    }


    public function hapusPegawai($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pegawai' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('Pegawai')->like('nama_pegawai', $keyword)->orLike('jabatan', $keyword);
    }
}
