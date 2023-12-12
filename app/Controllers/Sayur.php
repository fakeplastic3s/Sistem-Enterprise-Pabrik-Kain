<?php

namespace App\Controllers;

use App\Models\sayurModel;

use App\Controllers\BaseController;
use Config\Validation;

class Sayur extends BaseController
{
    public function index()
    {
        $model = new sayurModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getSayur;
        }
        $data['getSayur'] = $model->getSayur();
        $data['title'] = 'Data Sayur';
        echo view('/data/sayurView', $data);
    }

    public function tambahSayur()
    {
        session();
        $data['validation'] = \Config\Services::validation();
        $data['title'] = 'Tambah Data Sayur';
        return  view('/data/tambahSayurView', $data);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[tb_sayur . nama_barang]',
                'errors' => [
                    'required' => 'Nama barang  harus diisi',
                    'is_unique' => 'Nama barang sudah ada'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah stok harus diisi'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga beli harus diisi'
                ]
            ],
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/sayur/tambahSayur')->withInput()->with('validation', $validation);
        }
        $SayurModel = new SayurModel;
        $data = [
            'title' => 'Tambah Data Sayur',
            // 'id' => $this->request->getVar('id'),
            'nama_barang' => $this->request->getVar('nama'),
            'jumlah' => $this->request->getVar('jumlah'),
            'satuan' => $this->request->getVar('satuan'),
            'harga_beli' => $this->request->getVar('harga')
        ];
        $SayurModel->save($data);
        session()->setFlashdata('pesan_tambah', "Data Sayur Berhasil Ditambah");
        return redirect()->to('Sayur');
    }
    // edit
    public function edit($id)
    {
        session();
        $SayurModel = new SayurModel;
        $getSayur = $SayurModel->getSayur($id)->getRow();

        if (isset($getSayur)) {
            $data = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Sayur ' . $getSayur->nama_barang,
            ];
            $data['sayur'] = $getSayur;
            return view('/data/editSayurView', $data);
        } else {
            session()->setFlashdata('pesan_edit', 'Id barang tidak ditemukan');
            return redirect()->to('/Sayur');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[tb_sayur . nama_barang]',
                'errors' => [
                    'required' => 'Nama barang  harus diisi',
                    'is_unique' => 'Nama barang sudah ada'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/sayur/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $SayurModel = new SayurModel;
        $data = [
            'id_sayur' => $id,
            'nama_barang' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'harga_beli' => $this->request->getPost('harga')
        ];
        $SayurModel->save($data);
        session()->setFlashdata('pesan_tambah', "Data Sayur Berhasil Ditambah");
        return redirect()->to('Sayur');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new SayurModel;
        $getSayur = $model->getSayur($id)->getRow();
        if (isset($getSayur)) {
            $model->hapusBarang($id);
            session()->setFlashdata('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/Sayur');
        } else {
            session()->setFlashdata('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/Sayur');
        }
    }
}
