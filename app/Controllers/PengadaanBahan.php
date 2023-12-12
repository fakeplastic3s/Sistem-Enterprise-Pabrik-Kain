<?php

namespace App\Controllers;

use App\Models\PengadaanBahanModel;


use App\Controllers\BaseController;
use App\Models\SupplierModel;
use Config\Validation;

class PengadaanBahan extends BaseController
{
    public function index()
    {
        $model = new PengadaanBahanModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getPengadaanJoin();
        }
        $pengadaan['getPengadaan'] = $model->getPengadaanJoin();
        $pengadaan['title'] = 'Data Pengadaan Bahan';
        echo view('/pengadaan_bahan/pengadaanView', $pengadaan);
    }

    public function tambah()
    {
        session();
        $supplierModel = new SupplierModel();
        $pengadaan['supplier'] = $supplierModel->getSupplier();
        $pengadaan['validation'] = \Config\Services::validation();
        $pengadaan['title'] = 'Tambah Data Pengadaan Bahan';
        return  view('/pengadaan_bahan/tambahView', $pengadaan);
    }

    public function add()
    {
        if (!$this->validate([
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id supplier  harus diisi'
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
                    'required' => 'Jumlah bahan harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/PengadaanBahan/tambah')->withInput()->with('validation', $validation);
        }
        $PengadaanModel = new PengadaanBahanModel();
        $pengadaan = [
            'title' => 'Tambah Pengadaan Bahan',
            // 'id' => $this->request->getVar('id'),
            'id_supplier' => $this->request->getVar('supplier'),
            'tanggal_pengadaan' => $this->request->getVar('tanggal'),
            'jumlah' => $this->request->getVar('jumlah'),
            'status' => $this->request->getVar('status')
        ];
        $PengadaanModel->save($pengadaan);
        session()->setFlashData('pesan_tambah', "Data Pengadaan Bahan Berhasil Ditambah");
        return redirect()->to('PengadaanBahan');
    }
    // edit
    public function edit($id)
    {
        session();
        $SupplierModel = new SupplierModel;
        $model = new PengadaanBahanModel();
        $getPengadaan = $model->getPengadaan($id)->getRow();

        if (isset($getPengadaan)) {
            $pengadaan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Pengadaan Bahan ' . $getPengadaan->id_pengadaan,
            ];
            $pengadaan['supplier'] = $SupplierModel->getSupplier();
            $pengadaan['pengadaan'] = $getPengadaan;
            return view('/pengadaan_bahan/editView', $pengadaan);
        } else {
            session()->setFlashData('pesan_edit', 'Id Pengadaaan Bahan tidak ditemukan');
            return redirect()->to('/PengadaanBahan');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id supplier  harus diisi'
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
                    'required' => 'Jumlah bahan harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/PengadaanBahan/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $PengadaanModel = new PengadaanBahanModel();
        $pengadaan = [
            'id_supplier' => $id,
            'id_supplier' => $this->request->getPost('supplier'),
            'tanggal_pengadaan' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];
        // dd($pengadaan);
        $PengadaanModel->update($id, $pengadaan);
        session()->setFlashData('pesan_edit', "Data Pengadaan Bahan Berhasil Diedit");
        return redirect()->to('PengadaanBahan');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new PengadaanBahanModel();
        $getPengadaan = $model->getPengadaan($id)->getRow();
        if (isset($getPengadaan)) {
            $model->hapusPengadaan($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/PengadaanBahan');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/PengadaanBahan');
        }
    }
}
