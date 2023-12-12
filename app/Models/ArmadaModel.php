<?php

namespace App\Models;

use CodeIgniter\Model;

class ArmadaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table = 'armada';
    protected $primaryKey = 'plat_nomor';
    protected $allowedFields = ['plat_nomor', 'jenis_kendaraan', 'umur_kendaraan'];


    public function getArmada($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['plat_nomor' => $id])->getRowArray();
        }
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('armada')->like('plat_nomor', $keyword)->orLike('jenis_kendaraan', $keyword);
    }
}
