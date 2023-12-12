<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiAdminModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'presensi_admin';
    protected $primaryKey       = 'id_presensi_admin';
    protected $allowedFields    = ['id_presensi_admin', 'username', 'user_email', 'status', 'tanggal_presensi', 'waktu_presensi'];

    public function getPresensi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_presensi_admin' => $id]);
        }
    }
}
