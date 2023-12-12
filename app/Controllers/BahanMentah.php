<?php

namespace App\Controllers;

use App\Models\BahanMentahModel;


use App\Controllers\BaseController;

use Config\Validation;

class BahanMentah extends BaseController
{
    public function index()
    {
        $model = new BahanMentahModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getBahanMentah();
        }
        $bahanmentah = [
            'title' => 'Data Bahan Mentah',
            'getBahanMentah' => $model->getBahanMentah()

        ];
        echo view('/bahan_mentah/bahanmentahView', $bahanmentah);
    }

    public function tambah()
    {
        session();
        $bahanmentahModel = new BahanMentahModel();
        $bahanmentah['validation'] = \Config\Services::validation();
        $bahanmentah['title'] = 'Tambah Data Bahan Mentah';
        return  view('/bahan_mentah/tambahView', $bahanmentah);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[bahan_mentah . nama_bahan_mentah]',
                'errors' => [
                    'required' => 'Nama bahan  harus diisi',
                    'is_unique' => 'Nama bahan sudah ada'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah stok harus diisi'
                ]
            ],
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/BahanMentah/tambah')->withInput()->with('validation', $validation);
        }
        $BahanMentahModel = new BahanMentahModel();
        $bahanmentah = [
            'title' => 'Tambah Data Bahan Mentah',
            // 'id' => $this->request->getVar('id'),
            'nama_bahan_mentah' => $this->request->getVar('nama'),
            'jumlah_stok' => $this->request->getVar('jumlah')
        ];
        $BahanMentahModel->save($bahanmentah);
        session()->setFlashData('pesan_tambah', "Data Bahan Mentah Berhasil Ditambah");
        return redirect()->to('BahanMentah');
    }
    // edit
    public function edit($id)
    {
        session();
        $BahanMentahModel = new BahanMentahModel();
        $getBahanMentah = $BahanMentahModel->getBahanMentah($id)->getRow();
        if (isset($getBahanMentah)) {
            $bahanmentah = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Data Bahan Mentah ' . $getBahanMentah->nama_bahan_mentah,
                'bahanmentah' => $getBahanMentah
            ];
            return view('/bahan_mentah/editView', $bahanmentah);
        } else {
            session()->setFlashData('pesan_edit', 'Id bahan mentah tidak ditemukan');
            return redirect()->to('/BahanMentah');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama bahan  harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/BahanMentah/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $BahanMentahModel = new BahanMentahModel();
        $bahanmentah = [
            $id => $this->request->getPost('id'),
            'id_bahan_mentah' => $id,
            'nama_bahan_mentah' => $this->request->getPost('nama')
        ];
        $BahanMentahModel->update($id, $bahanmentah);
        session()->setFlashData('pesan_edit', "Data Bahan Mentah Berhasil Diedit");
        return redirect()->to('BahanMentah');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new BahanMentahModel();
        $getBahanMentah = $model->getBahanMentah($id)->getRow();
        if (isset($getBahanMentah)) {
            $model->hapusBahanMentah($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/BahanMentah');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/BahanMentah');
        }
    }
}
