<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanMentahModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bahan_mentah';
    protected $primaryKey       = 'id_bahan_mentah';
    protected $allowedFields    = ['id_bahan_mentah', 'nama_bahan_mentah', 'jumlah_stok'];


    public function getBahanMentah($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_bahan_mentah' => $id]);
        }
    }



    public function hapusBahanMentah($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_bahan_mentah' => $id]);
    }

    public function search($keyword)
    {
        // $builder = $this->table('tiket');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('bahan_mentah')->like('nama_bahan_mentah', $keyword)->orLike('jumlah_stok', $keyword);
        // return $this->table('bahan_mentah')
        //     ->join('bahan_masuk', 'bahan_masuk.id_bahan_masuk = bahan_mentah.id_bahan_masuk')
        //     ->like('nama_bahan_masuk', $keyword)->orLike('jumlah_stok', $keyword);
    }
}
