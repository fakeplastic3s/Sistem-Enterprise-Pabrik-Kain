<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanTerpakaiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bahan_terpakai';
    protected $primaryKey       = 'id_bahan_terpakai';
    protected $allowedFields    = ['id_bahan_terpakai', 'id_bahan_mentah', 'tanggal_pakai', 'jumlah'];


    public function getBahanTerpakai($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_bahan_terpakai' => $id]);
        }
    }

    public function getBahanTerpakaiJoin($id = false)
    {
        return $this->table('bahan_terpakai')
            ->join('bahan_mentah', 'bahan_mentah.id_bahan_mentah = bahan_terpakai.id_bahan_mentah')
            ->groupBy('bahan_terpakai.id_bahan_terpakai')
            ->orderBy('bahan_terpakai.id_bahan_terpakai', 'ASC')
            ->get()->getResultArray();
    }


    public function hapusBahanTerpakai($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_bahan_terpakai' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('bahan_terpakai')->like('nama_bahan_terpakai', $keyword)->orLike('tanggal_pakai', $keyword)->orLike('jumlah', $keyword);
    }

    public function laporanperBulan()
    {
        return $this->table('bahan_terpakai')
            ->join('bahan_mentah', 'bahan_mentah.id_bahan_mentah = bahan_terpakai.id_bahan_mentah')
            ->groupBy('MONTH(tanggal_pakai)')
            ->select('MONTH(tanggal_pakai) AS bulan,SUM(jumlah) AS total')
            ->get()->getResultArray();
    }
}
