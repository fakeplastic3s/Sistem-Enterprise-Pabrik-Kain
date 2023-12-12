<?php

namespace App\Controllers;

use App\Models\BahanMasukModel;


use App\Controllers\BaseController;
use App\Models\BahanMentahModel;
use App\Models\SupplierModel;
use Config\Validation;

class BahanMasuk extends BaseController
{
    public function index()
    {
        $model = new BahanMasukModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getBahanMasukJoin();
        }
        $bahanmasuk = [
            'title' => 'Data Bahan Masuk',
            'getBahanMasuk' => $model->getBahanMasukJoin()

        ];
        // dd($bahanmasuk);
        echo view('/bahan_masuk/bahanmasukView', $bahanmasuk);
    }

    public function tambahBahanMasuk()
    {
        session();
        $supplierModel = new SupplierModel();
        $bahanmentahModel = new BahanMentahModel();
        $bahanmasuk['supplier'] = $supplierModel->getSupplier();
        $bahanmasuk['bahanmentah'] = $bahanmentahModel->getBahanMentah();
        $bahanmasuk['validation'] = \Config\Services::validation();
        $bahanmasuk['title'] = 'Tambah Data Bahan Masuk';
        return  view('/bahan_masuk/tambahView', $bahanmasuk);
    }

    public function add()
    {
        if (!$this->validate([
            'bahanmentah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id bahan mentah harus diisi'
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Supplier harus diisi'
                ]
            ],
            'bahanmentah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id bahan mentah harus diisi'
                ]
            ],
            'tanggal' => [
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
            return redirect()->to('/BahanMasuk/tambahBahanMasuk')->withInput()->with('validation', $validation);
        }
        $BahanMasukModel = new BahanMasukModel();
        $bahanmasuk = [
            'title' => 'Tambah Data Bahan Masuk',
            // 'id' => $this->request->getVar('id'),
            'id_bahan_mentah' => $this->request->getVar('bahanmentah'),
            'id_supplier' => $this->request->getVar('supplier'),
            'tanggal_masuk' => $this->request->getVar('tanggal'),
            'jumlah' => $this->request->getVar('jumlah')
        ];
        // dd($bahanmasuk);
        $BahanMasukModel->save($bahanmasuk);
        session()->setFlashData('pesan_tambah', "Data Bahan Masuk Berhasil Ditambah");
        return redirect()->to('BahanMasuk');
    }
    // edit
    public function edit($id)
    {
        session();
        $BahanMasukModel = new BahanMasukModel();
        $SupplierModel = new SupplierModel();
        $BahanMentahModel = new BahanMentahModel();
        $getBahanMasuk = $BahanMasukModel->getBahanMasuk($id)->getRow();

        if (isset($getBahanMasuk)) {
            $bahanmasuk = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Data Bahan Masuk ' . $getBahanMasuk->id_bahan_masuk,
            ];
            $bahanmasuk['bahanmasuk'] = $getBahanMasuk;
            $bahanmasuk['supplier'] = $SupplierModel->getSupplier();
            $bahanmasuk['bahanmentah'] = $BahanMentahModel->getBahanMentah();


            return view('/bahan_masuk/editView', $bahanmasuk);
        } else {
            session()->setFlashData('pesan_edit', 'Id bahan masuk tidak ditemukan');
            return redirect()->to('/BahanMasuk');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'bahanmentah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id bahan mentah harus diisi'
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Supplier harus diisi'
                ]
            ],
            'tanggal' => [
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
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/BahanMasuk/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $BahanMasukModel = new BahanMasukModel();
        $bahanmasuk = [
            $id => $this->request->getPost('id'),
            'id_bahan_masuk' => $id,
            'id_bahan_mentah' => $this->request->getVar('bahanmentah'),
            'id_supplier' => $this->request->getPost('supplier'),
            'tanggal_masuk' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah')
        ];
        // dd($bahanmasuk);
        $BahanMasukModel->update($id, $bahanmasuk);
        session()->setFlashData('pesan_edit', "Data Bahan Masuk Berhasil Diedit");
        return redirect()->to('BahanMasuk');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new BahanMasukModel();
        $getBahanMasuk = $model->getBahanMasuk($id)->getRow();
        if (isset($getBahanMasuk)) {
            $model->hapusBahanMasuk($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/BahanMasuk');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/BahanMasuk');
        }
    }
}
