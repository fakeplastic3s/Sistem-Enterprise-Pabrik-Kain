<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanMentahModel;
use App\Models\BahanTerpakaiModel;
use App\Models\SupplierModel;
use Config\Validation;

class BahanTerpakai extends BaseController
{
    public function index()
    {
        $model = new BahanTerpakaiModel();
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getBahanTerpakaiJoin();
        }
        $bahanterpakai = [
            'title' => 'Data Bahan Terpakai',
            'getBahanTerpakai' => $model->getBahanTerpakaiJoin()

        ];
        // dd($bahanmasuk);
        echo view('/bahan_terpakai/bahanterpakaiView', $bahanterpakai);
    }

    public function tambah()
    {
        session();
        $bahanmentahModel = new BahanMentahModel();
        $bahanterpakai['bahanmentah'] = $bahanmentahModel->getBahanMentah();
        $bahanterpakai['validation'] = \Config\Services::validation();
        $bahanterpakai['title'] = 'Tambah Data Bahan Terpakai';
        return  view('/bahan_terpakai/tambahView', $bahanterpakai);
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
            return redirect()->to('/BahanTerpakai/tambah')->withInput()->with('validation', $validation);
        }
        $bahanmentah = new BahanMentahModel();
        $id_bahan_mentah = $this->request->getVar('bahanmentah');
        $jumlahInput = $this->request->getVar('jumlah');
        $getStokBahan =  $bahanmentah->getBahanMentah($id_bahan_mentah)->getRow();
        // dd($getStokBahan);

        // Mengecek apakah jumlah yang diinputkan lebih besar dari jumlah stok yang ada
        if ($jumlahInput > $getStokBahan->jumlah_stok) {
            session()->setFlashData('warning', "Jumlah Stok Tidak Mencukupi ! Jumlah stok " . $getStokBahan->nama_bahan_mentah . " saat ini adalah " . $getStokBahan->jumlah_stok);
            return redirect()->to('BahanTerpakai/tambah')->withInput();
        } else {
            $BahanTerpakaiModel = new BahanTerpakaiModel();
            $bahanterpakai = [
                'title' => 'Tambah Data Bahan Terpakai',
                // 'id' => $this->request->getVar('id'),
                'id_bahan_mentah' => $this->request->getVar('bahanmentah'),
                'tanggal_pakai' => $this->request->getVar('tanggal'),
                'jumlah' => $this->request->getVar('jumlah')
            ];
            // dd($bahanmasuk);
            $BahanTerpakaiModel->save($bahanterpakai);
            session()->setFlashData('pesan_tambah', "Data Bahan Terpakai Berhasil Ditambah");
            return redirect()->to('BahanTerpakai');
        }
    }
    // edit
    public function edit($id)
    {
        session();
        $BahanTerpakaiModel = new BahanTerpakaiModel();
        $SupplierModel = new SupplierModel();
        $BahanMentahModel = new BahanMentahModel();
        $getBahanTerpakai = $BahanTerpakaiModel->getBahanTerpakai($id)->getRow();

        if (isset($getBahanTerpakai)) {
            $bahanterpakai = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Data Bahan Terpakai ' . $getBahanTerpakai->id_bahan_terpakai,
            ];
            $bahanterpakai['bahanterpakai'] = $getBahanTerpakai;
            $bahanterpakai['bahanmentah'] = $BahanMentahModel->getBahanMentah();


            return view('/bahan_terpakai/editView', $bahanterpakai);
        } else {
            session()->setFlashData('pesan_edit', 'Id bahan terpakai tidak ditemukan');
            return redirect()->to('/BahanTerpakai');
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
            return redirect()->to('/BahanTerpakai/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $BahanTerpakaiModel = new BahanTerpakaiModel();
        $bahanterpakai = [
            $id => $this->request->getPost('id'),
            'id_bahan_terpakai' => $id,
            'id_bahan_mentah' => $this->request->getVar('bahanmentah'),
            'tanggal_pakai' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah')
        ];
        // dd($bahanmasuk);
        $BahanTerpakaiModel->update($id, $bahanterpakai);
        session()->setFlashData('pesan_edit', "Data Bahan Terpakai Berhasil Diedit");
        return redirect()->to('BahanTerpakai');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new BahanTerpakaiModel();
        $getBahanTerpakai = $model->getBahanTerpakai($id)->getRow();
        if (isset($getBahanTerpakai)) {
            $model->hapusBahanTerpakai($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/BahanTerpakai');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/BahanTerpakai');
        }
    }
}
