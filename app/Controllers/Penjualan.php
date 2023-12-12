<?php

namespace App\Controllers;

use App\Models\PenjualanModel;


use App\Controllers\BaseController;
use App\Models\StokBarangJadiModel;
use App\Models\SalesMarketingModel;
use Config\Validation;

class Penjualan extends BaseController
{
    public function index()
    {
        $model = new PenjualanModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getPenjualanJoin();
        }
        $penjualan = [
            'title' => 'Data Penjualan',
            'getPenjualan' => $model->getPenjualanJoin()

        ];
        // dd($penjualan);
        echo view('/penjualan/penjualanView', $penjualan);
    }

    public function tambahPenjualan()
    {
        session();
        $supplierModel = new SalesMarketingModel();
        $bahanmentahModel = new StokBarangJadiModel();
        $penjualan['salesmarketing'] = $supplierModel->getSalesMarketing();
        $penjualan['stokbarangjadi'] = $bahanmentahModel->getStokBarangJadi();
        $penjualan['validation'] = \Config\Services::validation();
        $penjualan['title'] = 'Tambah Data Penjualan';
        return  view('/penjualan/tambahView', $penjualan);
    }

    public function add()
    {
        if (!$this->validate([
            'stokbarangjadi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id barang harus diisi'
                ]
            ],
            'salesmarketing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id Sales harus diisi'
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
            return redirect()->to('/Penjualan/tambahPenjualan')->withInput()->with('validation', $validation);
        }
        $stokbarang = new StokBarangJadiModel();
        $id_barang      = $this->request->getVar('stokbarangjadi');
        $jumlahInput    = $this->request->getVar('jumlah');
        $getJumlahStok = $stokbarang->getStokBarangJadi($id_barang)->getRow();

        // Mengecek apakah jumlah yang diinputkan lebih besar dari jumlah stok yang ada
        if ($jumlahInput > $getJumlahStok->jumlah) {
            session()->setFlashData('warning', "Jumlah Stok Tidak Mencukupi ! Jumlah stok " . $getJumlahStok->nama_barang . " saat ini adalah " . $getJumlahStok->jumlah);
            return redirect()->to('Penjualan/tambahPenjualan')->withInput();
        } else {
            $PenjualanModel = new PenjualanModel();
            $penjualan = [
                'title' => 'Tambah Data Penjualan',
                // 'id' => $this->request->getVar('id'),
                'id_barang' => $this->request->getVar('stokbarangjadi'),
                'id_sales' => $this->request->getVar('salesmarketing'),
                'tanggal_penjualan' => $this->request->getVar('tanggal'),
                'jumlah_penjualan' => $this->request->getVar('jumlah')
            ];
            // dd($penjualan);
            $PenjualanModel->save($penjualan);
            session()->setFlashData('pesan_tambah', "Data Penjualan Berhasil Ditambah");
            return redirect()->to('Penjualan');
        }
    }
    // edit
    public function edit($id)
    {
        session();
        $PenjualanModel = new PenjualanModel();
        $SalesMarketingModel = new SalesMarketingModel();
        $StokBarangJadiModel = new StokBarangJadiModel();
        $getPenjualan = $PenjualanModel->getPenjualan($id)->getRow();

        if (isset($getPenjualan)) {
            $penjualan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Data Penjualan ' . $getPenjualan->id_penjualan,
            ];
            $penjualan['penjualan'] = $getPenjualan;
            $penjualan['salesmarketing'] = $SalesMarketingModel->getSalesMarketing();
            $penjualan['stokbarangjadi'] = $StokBarangJadiModel->getStokBarangJadi();


            return view('/penjualan/editView', $penjualan);
        } else {
            session()->setFlashData('pesan_edit', 'Id Penjualan tidak ditemukan');
            return redirect()->to('/Penjualan');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'stokbarangjadi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id barang harus diisi'
                ]
            ],
            'salesmarketing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id sales harus diisi'
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
            return redirect()->to('/Penjualan/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $PenjualanModel = new PenjualanModel();
        $penjualan = [
            $id => $this->request->getPost('id'),
            'id_penjualan' => $id,
            'id_barang' => $this->request->getVar('stokbarangjadi'),
            'id_sales' => $this->request->getPost('salesmarketing'),
            'tanggal_penjualan' => $this->request->getPost('tanggal'),
            'jumlah_penjualan' => $this->request->getPost('jumlah')
        ];

        $PenjualanModel->update($id, $penjualan);
        session()->setFlashData('pesan_edit', "Data Penjualan Berhasil Diedit");
        return redirect()->to('Penjualan');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new PenjualanModel();
        $getPenjualan = $model->getPenjualan($id)->getRow();
        if (isset($getPenjualan)) {
            $model->hapusPenjualan($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/Penjualan');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/Penjualan');
        }
    }
}
