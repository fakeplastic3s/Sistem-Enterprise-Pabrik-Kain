<?php

namespace App\Controllers;

use App\Models\PegawaiModel;


use App\Controllers\BaseController;
use Config\Validation;

class Pegawai extends BaseController
{
    public function index()
    {
        $model = new PegawaiModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getPegawai;
        }
        $pegawai['getPegawai'] = $model->getPegawai();
        $pegawai['title'] = 'Data Pegawai';
        echo view('/pegawai/pegawaiView', $pegawai);
    }

    public function tambahPegawai()
    {
        session();
        $pegawai['validation'] = \Config\Services::validation();
        $pegawai['title'] = 'Tambah Data pegawai';
        return  view('/pegawai/tambahPegawaiView', $pegawai);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[pegawai . nama_pegawai]',
                'errors' => [
                    'required' => 'Nama pegawai  harus diisi',
                    'is_unique' => 'Nama pegawai sudah ada'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'alamat harus diisi'
                ]
            ],
            'gaji' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jabatan harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/Pegawai/tambahPegawai')->withInput()->with('validation', $validation);
        }
        $PegawaiModel = new PegawaiModel;
        $pegawai = [
            'title' => 'Tambah Data Pegawai',
            // 'id' => $this->request->getVar('id'),
            'nama_pegawai' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'jabatan' => $this->request->getVar('jabatan'),
            'gaji_pokok' => $this->request->getVar('gaji')
        ];
        $PegawaiModel->save($pegawai);
        session()->setFlashData('pesan_tambah', "Data pegawai Berhasil Ditambah");
        return redirect()->to('Pegawai');
    }
    // edit
    public function edit($id)
    {
        session();

        $PegawaiModel = new PegawaiModel;
        $getPegawai = $PegawaiModel->getPegawai($id)->getRow();

        if (isset($getPegawai)) {
            $pegawai = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Pegawai ' . $getPegawai->nama_pegawai,
            ];
            $pegawai['pegawai'] = $getPegawai;
            return view('/Pegawai/editPegawaiView', $pegawai);
        } else {
            session()->setFlashData('pesan_edit', 'Id Pegawai tidak ditemukan');
            return redirect()->to('/Pegawai');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pegawai  harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/Pegawai/update/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $PegawaiModel = new PegawaiModel;
        $pegawai = [
            'id_pegawai' => $id,
            'nama_pegawai' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'jabatan' => $this->request->getPost('jabatan'),
            'gaji_pokok' => $this->request->getPost('gaji')
        ];
        // dd($pegawai);
        $PegawaiModel->update($id, $pegawai);
        session()->setFlashData('pesan_edit', "Data Pegawai Berhasil Diedit");
        return redirect()->to('Pegawai');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new PegawaiModel;
        $getPegawai = $model->getPegawai($id)->getRow();
        if (isset($getPegawai)) {
            $model->hapuspegawai($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/Pegawai');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/Pegawair');
        }
    }
}
