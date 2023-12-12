<?php

namespace App\Controllers;

use App\Models\KebutuhanProduksiModel;


use App\Controllers\BaseController;

use Config\Validation;

class KebutuhanProduksi extends BaseController
{
    public function index()
    {
        $model = new KebutuhanProduksiModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getKebutuhanProduksi();
        }
        $kebutuhanproduksi = [
            'title' => 'Data Kebutuhan Produksi',
            'getKebutuhanProduksi' => $model->getKebutuhanProduksi()

        ];
        echo view('/kebutuhan_produksi/kebutuhanproduksiView', $kebutuhanproduksi);
    }

    public function tambah()
    {
        session();
        $kebutuhanproduksiModel = new KebutuhanProduksiModel();
        $kebutuhanproduksi['validation'] = \Config\Services::validation();
        $kebutuhanproduksi['title'] = 'Tambah Data Kebutuhan Produksi';
        return  view('/kebutuhan_produksi/tambahView', $kebutuhanproduksi);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[kebutuhan_produksi . nama_barang]',
                'errors' => [
                    'required' => 'Nama barang  harus diisi',
                    'is_unique' => 'Nama barang sudah ada'
                ]
            ],
            'bahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'bahan harus diisi'
                ]
            ],
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/KebutuhanProduksi/tambah')->withInput()->with('validation', $validation);
        }
        $KebutuhanProduksiModel = new KebutuhanProduksiModel();
        $kebutuhanproduksi = [
            'title' => 'Tambah Data Kebutuhan Produksi',
            // 'id' => $this->request->getVar('id'),
            'nama_barang' => $this->request->getVar('nama'),
            'bahan' => $this->request->getVar('bahan')
        ];
        $KebutuhanProduksiModel->save($kebutuhanproduksi);
        session()->setFlashData('pesan_tambah', "Data Kebutuhan Produksi Berhasil Ditambah");
        return redirect()->to('KebutuhanProduksi');
    }
    // edit
    public function edit($id)
    {
        session();
        $KebutuhanProduksiModel = new KebutuhanProduksiModel();
        $getKebutuhanProduksi = $KebutuhanProduksiModel->getKebutuhanProduksi($id)->getRow();
        if (isset($getKebutuhanProduksi)) {
            $kebutuhanproduksi = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Kebutuhan Produksi ' . $getKebutuhanProduksi->nama_barang,
                'kebutuhanproduksi' => $getKebutuhanProduksi
            ];
            return view('/kebutuhan_produksi/editView', $kebutuhanproduksi);
        } else {
            session()->setFlashData('pesan_edit', 'Id kebutuhan produksi tidak ditemukan');
            return redirect()->to('/KebutuhanProduksi');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi'
                ]
            ],
            'bahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bahan harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/KebutuhanProduksi/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $KebutuhanProduksiModel = new KebutuhanProduksiModel();
        $kebutuhanproduksi = [
            $id => $this->request->getPost('id'),
            'id_kebutuhan_produksi' => $id,
            'nama_barang' => $this->request->getPost('nama'),
            'bahan' => $this->request->getPost('bahan')
        ];
        $KebutuhanProduksiModel->update($id, $kebutuhanproduksi);
        session()->setFlashData('pesan_edit', "Data Kebutuhan Produksi Berhasil Diedit");
        return redirect()->to('KebutuhanProduksi');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new KebutuhanProduksiModel();
        $getKebutuhanProduksi = $model->getKebutuhanProduksi($id)->getRow();
        if (isset($getKebutuhanProduksi)) {
            $model->hapusKebutuhanProduksi($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/KebutuhanProduksi');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/KebutuhanProduksi');
        }
    }
}
