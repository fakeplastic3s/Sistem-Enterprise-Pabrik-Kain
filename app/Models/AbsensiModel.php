<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'absensi';
    protected $primaryKey       = 'id_absensi';
    protected $allowedFields    = ['id_absensi', 'id_pegawai', 'tanggal_hadir', 'status'];


    public function getPegawai($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_absensi' => $id]);
        }
    }

    public function countAll()
    {
        return $this->table('absensi')
            ->join('pegawai', 'pegawai.id_pegawai = absensi.id_pegawai')
            ->select('pegawai.nama_pegawai, COUNT(*) as Jumlah')
            ->groupBy('absensi.id_pegawai')
            ->get()->getResultArray();
    }
    public function countHadir()
    {
        return $this->table('absensi')
            ->join('pegawai', 'pegawai.id_pegawai = absensi.id_pegawai')
            ->select('pegawai.nama_pegawai,absensi.status, COUNT(*) as Jumlah')
            ->where('status', 'Hadir')
            ->groupBy('absensi.id_pegawai')
            ->get()->getResultArray();
    }
    public function countIzin()
    {
        return $this->table('absensi')
            ->join('pegawai', 'pegawai.id_pegawai = absensi.id_pegawai')
            ->select('pegawai.nama_pegawai,absensi.status, COUNT(*) as Izin')
            ->where('status', 'Izin')
            ->groupBy('absensi.id_pegawai')
            ->get()->getResultArray();
    }

    public function getAllAbseni()
    {
        return $this->table('absensi')
            ->join('pegawai', 'pegawai.id_pegawai = absensi.id_pegawai')
            ->orderBy('absensi.tanggal_hadir', 'ASC')
            ->get()->getResultArray();
    }
    // public function countHadir()
    // {
    //     return $this->table('absensi')
    //         ->select('status, COUNT(*) as jumlah')
    //         ->where('status', 'Hadir')
    //         ->groupBy('id_pegawai')
    //         ->get()->getResultArray();
    // }

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
