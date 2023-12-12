<?php

namespace App\Controllers;

use App\Models\HasilProduksiModel;


use App\Controllers\BaseController;
use Config\Validation;

class HasilProduksi extends BaseController
{
    public function index()
    {
        $model = new HasilProduksiModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getHasilProduksi;
        }
        $hasilproduksi['getHasilProduksi'] = $model->getHasilProduksiJoin();
        $hasilproduksi['title'] = 'Data Hasil Produksi';
        echo view('/hasil_produksi/hasilproduksiView', $hasilproduksi);
    }

    public function tambahHasilProduksi()
    {
        session();
        $model = new HasilProduksiModel();
        $hasilproduksi['validation'] = \Config\Services::validation();
        $hasilproduksi['title'] = 'Tambah Data Hasil Produksi';
        $hasilproduksi['data'] = $model->getNamaBarang();
        return  view('/hasil_produksi/tambahHasilProduksiView', $hasilproduksi);
    }

    public function add()
    {
        if (!$this->validate([
            'id_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang harus diisi'
                ]
            ],
            'tanggal_produksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Produksi harus diisi'
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
            return redirect()->to('/hasilproduksi/tambahHasilProduksi')->withInput()->with('validation', $validation);
        }
        $HasilProduksiModel = new HasilProduksiModel;
        $hasilproduksi = [
            'title' => 'Tambah DataHasilProduksi',
            // 'id' => $this->request->getVar('id'),
            'id_barang' => $this->request->getVar('id_barang'),
            'tanggal_produksi' => $this->request->getVar('tanggal_produksi'),
            'jumlah_hasil_produksi' => $this->request->getVar('jumlah')
        ];
        $HasilProduksiModel->save($hasilproduksi);
        session()->setFlashData('pesan_tambah', "Data Hasil Produksi Berhasil Ditambah");
        return redirect()->to('HasilProduksi');
    }
    // edit
    public function edit($id)
    {
        session();
        $HasilProduksiModel = new HasilProduksiModel;
        $getHasilProduksi = $HasilProduksiModel->getHasilProduksi($id)->getRow();

        if (isset($getHasilProduksi)) {
            $hasilproduksi = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Hasil Produksi ' . $getHasilProduksi->id_hasil_produksi,
            ];
            $hasilproduksi['hasilproduksi'] = $getHasilProduksi;
            $hasilproduksi['data'] = $HasilProduksiModel->getHasilProduksi($id)->getRowArray();
            $hasilproduksi['getNamaBarang'] = $HasilProduksiModel->getNamaBarang();
            return view('/hasil_produksi/editHasilProduksiView', $hasilproduksi);
        } else {
            session()->setFlashData('pesan_edit', 'Id hasil produksi tidak ditemukan');
            return redirect()->to('/HasilProduksi');
        }
    }

    public function update($id)
    {
        $HasilProduksiModel = new HasilProduksiModel;
        $hasilproduksi = [
            'id_hasil_produksi' => $id,
            'id_barang' => $this->request->getPost('id_barang'),
            'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
            'jumlah_hasil_produksi' => $this->request->getPost('jumlah')
        ];
        // dd($hasilproduksi);
        $HasilProduksiModel->update($id, $hasilproduksi);
        session()->setFlashData('pesan_edit', "Data Hasil Produksi Berhasil Diedit");
        return redirect()->to('HasilProduksi');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new HasilProduksiModel;
        $getHasilProduksi = $model->getHasilProduksi($id)->getRow();
        if (isset($getHasilProduksi)) {
            $model->hapushasilproduksi($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/HasilProduksi');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/HasilProduksi');
        }
    }
}
