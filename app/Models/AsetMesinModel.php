<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetMesinModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'aset_mesin';
    protected $primaryKey       = 'id_mesin';
    protected $allowedFields    = ['id_mesin', 'nama_mesin', 'merk', 'tgl_pengadaan', 'jumlah'];


    public function getAsetMesin($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_mesin' => $id]);
        }
    }


    public function hapusAsetMesin($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_mesin' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('AsetMesin')->like('nama_mesin', $keyword)->orLike('nama_barang', $keyword);
    }
}
