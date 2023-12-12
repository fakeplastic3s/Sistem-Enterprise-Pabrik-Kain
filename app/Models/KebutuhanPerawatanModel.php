<?php

namespace App\Models;

use CodeIgniter\Model;

class KebutuhanPerawatanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kebutuhan_perawatan';
    protected $primaryKey       = 'id_kebutuhan_perawatan';
    protected $allowedFields    = ['id_kebutuhan_perawatan', 'id_mesin', 'kebutuhan_perawatan', 'status'];


    public function getKebutuhanPerawatan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_kebutuhan_perawatan' => $id]);
        }
    }



    public function getKebutuhanPerawatanJoin($id = false)
    {
        return $this->table('kebutuhan_perawatan')
            ->join('aset_mesin', 'aset_mesin.id_mesin = kebutuhan_perawatan.id_mesin')
            ->get()->getResultArray();
    }


    public function hapusKebutuhanPerawatan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_kebutuhan_perawatan' => $id]);
    }

    public function countDiajukan()
    {
        return $this->table('kebutuhan_perawatan')
            ->selectcount('status')
            ->where('status', "Diajukan")
            ->get()->getRow();
    }
    public function countDisetujui()
    {
        return $this->table('kebutuhan_perawatan')
            ->selectcount('status')
            ->where('status', "Disetujui")
            ->get()->getRow();
    }
    public function countDitolak()
    {
        return $this->table('kebutuhan_perawatan')
            ->selectcount('status')
            ->where('status', "Ditolak")
            ->get()->getRow();
    }

    public function search($keyword)
    {

        return $this->table('kebutuhan_perawatan')
            ->like('nama_mesin', $keyword)->orLike('kebutuhan_perawatan', $keyword)->orLike('status', $keyword);
    }
}
