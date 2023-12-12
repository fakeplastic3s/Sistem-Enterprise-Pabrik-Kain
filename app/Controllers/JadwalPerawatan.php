<?php

namespace App\Controllers;

use App\Models\JadwalPerawatanModel;


use App\Controllers\BaseController;
use App\Models\AsetMesinModel;
use Config\Validation;

class JadwalPerawatan extends BaseController
{
    public function index()
    {
        $model = new JadwalPerawatanModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getJadwalPerawatanJoin();
        }
        $jadwalperawatan = [
            'title' => 'Data Jadwal Perawatan',
            'getJadwalPerawatan' => $model->getJadwalPerawatanJoin()

        ];
        // dd($bahanmasuk);
        echo view('/jadwal_perawatan/jadwalperawatanView', $jadwalperawatan);
    }

    public function tambahJadwalPerawatan()
    {
        session();
        $asetmesinModel = new AsetMesinModel();
        $jadwalperawatan['asetmesin'] = $asetmesinModel->getAsetMesin();
        $jadwalperawatan['validation'] = \Config\Services::validation();
        $jadwalperawatan['title'] = 'Tambah Data Jadwal Perawatan';
        return  view('/jadwal_perawatan/tambahView', $jadwalperawatan);
    }

    public function add()
    {
        if (!$this->validate([
            'asetmesin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama bahan  harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/JadwalPerawatan/tambahJadwalPerawatan')->withInput()->with('validation', $validation);
        }
        $JadwalPerawatanModel = new JadwalPerawatanModel();
        $jadwalperawatan = [
            'title' => 'Tambah Jadwal Perawatan',
            'id_mesin' => $this->request->getVar('asetmesin'),
            'tanggal_perawatan' => $this->request->getVar('tanggal'),
            'status' => $this->request->getVar('status')
        ];
        // dd($jadwalperawatan);
        $JadwalPerawatanModel->save($jadwalperawatan);
        session()->setFlashData('pesan_tambah', "Data Jadwal Perawatan Berhasil Ditambah");
        return redirect()->to('JadwalPerawatan');
    }
    // edit
    public function edit($id)
    {
        session();
        $JadwalPerawatanModel = new JadwalPerawatanModel();
        $AsetMesinModel = new AsetMesinModel();
        $getJadwalPerawatan = $JadwalPerawatanModel->getJadwalPerawatan($id)->getRow();
        $getStokBarangJadi = $AsetMesinModel->getAsetMesin($id)->getRow();

        if (isset($getJadwalPerawatan)) {
            $jadwalperawatan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Jadwal Perawatan ' . $getJadwalPerawatan->tanggal_perawatan,
            ];
            $jadwalperawatan['jadwalperawatan'] = $getJadwalPerawatan;
            $jadwalperawatan['asetmesin'] = $AsetMesinModel->getAsetMesin();


            return view('/jadwal_perawatan/editView', $jadwalperawatan);
        } else {
            session()->setFlashData('pesan_edit', 'Id perawatan tidak ditemukan');
            return redirect()->to('/JadwalPerawatan');
        }
    }

    public function update($id)
    {
        $JadwalPerawatanModel = new JadwalPerawatanModel();
        $jadwalperawatan = [
            $id => $this->request->getPost('id'),
            'id_perawatan' => $id,
            'id_mesin' => $this->request->getVar('asetmesin'),
            'tanggal_perawatan' => $this->request->getVar('tanggal'),
            'status' => $this->request->getVar('status')
        ];
        // dd($jadwalperawatan);
        $JadwalPerawatanModel->update($id, $jadwalperawatan);
        session()->setFlashData('pesan_edit', "Data Jadwal Perawatan Berhasil Diedit");
        return redirect()->to('JadwalPerawatan');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new JadwalPerawatanModel();
        $getJadwalPerawatan = $model->getJadwalPerawatan($id)->getRow();
        if (isset($getJadwalPerawatan)) {
            $model->hapusJadwalPerawatan($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/JadwalPerawatan');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/JadwalPerawatan');
        }
    }
}
