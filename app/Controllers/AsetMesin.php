<?php

namespace App\Controllers;

use App\Models\AsetMesinModel;


use App\Controllers\BaseController;
use Config\Validation;

class AsetMesin extends BaseController
{
    public function index()
    {
        $model = new AsetMesinModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getAsetMesin;
        }
        $asetmesin['getAsetMesin'] = $model->getAsetMesin();
        $asetmesin['title'] = 'Data Mesin';
        echo view('/aset_mesin/AsetMesinView', $asetmesin);
    }

    public function tambahAsetMesin()
    {
        session();
        $asetmesin['validation'] = \Config\Services::validation();
        $asetmesin['title'] = 'Tambah Data Mesin';
        return  view('/aset_mesin/tambahAsetMesinView', $asetmesin);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[aset_mesin . nama_mesin]',
                'errors' => [
                    'required' => 'Nama mesin  harus diisi',
                    'is_unique' => 'Nama mesin sudah ada'
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Merk harus diisi'
                ]
            ],
            'tgl_pengadaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah harus diisi'
                ]
            ],
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/AsetMesin/tambahAsetMesin')->withInput()->with('validation', $validation);
        }
        $AsetMesinModel = new AsetMesinModel;
        $asetmesin = [
            'title' => 'Tambah Data Mesin',
            // 'id' => $this->request->getVar('id'),
            'nama_mesin' => $this->request->getVar('nama'),
            'merk' => $this->request->getVar('merk'),
            'tgl_pengadaan' => $this->request->getVar('tgl_pengadaan'),
            'jumlah' => $this->request->getVar('jumlah')
        ];
        $AsetMesinModel->save($asetmesin);
        session()->setFlashData('pesan_tambah', "Data Mesin Berhasil Ditambah");
        return redirect()->to('AsetMesin');
    }
    // edit
    public function edit($id)
    {
        session();
        $AsetMesinModel = new AsetMesinModel;
        $getAsetMesin = $AsetMesinModel->getAsetMesin($id)->getRow();

        if (isset($getAsetMesin)) {
            $asetmesin = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Mesin ' . $getAsetMesin->nama_mesin,
            ];
            $asetmesin['asetmesin'] = $getAsetMesin;
            return view('/aset_mesin/editAsetMesinView', $asetmesin);
        } else {
            session()->setFlashData('pesan_edit', 'Id mesin tidak ditemukan');
            return redirect()->to('/AsetMesin');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Mesin  harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/AsetMesin/update/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $AsetMesinModel = new AsetMesinModel;
        $asetmesin = [
            'id_mesin' => $id,
            'nama_mesin' => $this->request->getPost('nama'),
            'merk' => $this->request->getPost('merk'),
            'tgl_pengadaan' => $this->request->getPost('tgl_pengadaan'),
            'jumlah' => $this->request->getPost('jumlah')
        ];
        // dd($asetmesin);
        $AsetMesinModel->update($id, $asetmesin);
        session()->setFlashData('pesan_edit', "Data Mesin Berhasil Diedit");
        return redirect()->to('AsetMesin');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new AsetMesinModel;
        $getAsetMesin = $model->getAsetMesin($id)->getRow();
        if (isset($getAsetMesin)) {
            $model->hapusasetmesin($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/AsetMesin');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/AsetMesin');
        }
    }
}
