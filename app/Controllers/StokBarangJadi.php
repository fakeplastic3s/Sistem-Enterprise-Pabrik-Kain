<?php

namespace App\Controllers;

use App\Models\StokBarangJadiModel;


use App\Controllers\BaseController;
use Config\Validation;

class StokBarangJadi extends BaseController
{
    public function index()
    {
        $model = new StokBarangJadiModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getStokBarangJadi;
        }
        $stokbarangjadi['getStokBarangJadi'] = $model->getStokBarangJadi();
        $stokbarangjadi['title'] = 'Data Stok Barang Jadi';
        echo view('/stok_barang_jadi/stokView', $stokbarangjadi);
    }

    public function tambahStokBarangJadi()
    {
        session();
        $stokbarangjadi['validation'] = \Config\Services::validation();
        $stokbarangjadi['title'] = 'Tambah Data Stok Barang Jadi';
        return  view('/stok_barang_jadi/tambahView', $stokbarangjadi);
    }

    public function add()
    {
        $gambar = $this->request->getFile('gambar');
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,5024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Pilih File / Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();

            return redirect()->to('/StokBarangJadi/tambahStokBarangJadi')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('gambar');
        // dd($fileSampul);

        // apakah tidak ada gambar yang di upload 
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();

            // pindahkan file ke folder img
            $fileSampul->move('img/stokbarangjadi', $namaSampul);
        }
        $StokBarangJadiModel = new StokBarangJadiModel;
        $stokbarangjadi = [
            'title' => 'Tambah Data Stok Barang Jadi',
            // 'id' => $this->request->getVar('id'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'jumlah' => $this->request->getVar('jumlah'),
            'harga' => $this->request->getVar('harga'),
            'gambar' => $namaSampul
        ];
        $StokBarangJadiModel->save($stokbarangjadi);
        session()->setFlashData('pesan_tambah', "Data Stok Barang Jadi Berhasil Ditambah");
        return redirect()->to('StokBarangJadi');
    }
    // edit
    public function edit($id)
    {
        session();
        $StokBarangJadiModel = new StokBarangJadiModel;
        $getStokBarangJadi = $StokBarangJadiModel->getStokBarangJadi($id)->getRow();

        if (isset($getStokBarangJadi)) {
            $stokbarangjadi = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Stok Barang Jadi ' . $getStokBarangJadi->nama_barang,
            ];
            $stokbarangjadi['stokbarangjadi'] = $getStokBarangJadi;
            return view('/stok_barang_jadi/editView', $stokbarangjadi);
        } else {
            session()->setFlashData('pesan_edit', 'Id stok barang jadi tidak ditemukan');
            return redirect()->to('/StokBarangJadi');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang  harus diisi'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,10024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Pilih File / Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/StokBarangJadi/edit/' . $this->request->getPost('id'))->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('gambar');

        // apakah tidak ada gambar yang di upload
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('gambarLama');
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();

            // pindahkan file ke folder img
            $fileSampul->move('img/stokbarangjadi', $namaSampul);

            // hapus file lama
            // if ($this->request->getVar('gambarLama') != 'default.jpg') {
            //     unlink('img/stokbarangjadi/' . $this->request->getVar('gambarLama'));
            // }
        }

        $StokBarangJadiModel = new StokBarangJadiModel;
        $stokbarangjadi = [
            $id => $this->request->getPost('id'),
            'id_barang' => $id,
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'gambar' => $namaSampul
        ];
        // dd($supplier);
        $StokBarangJadiModel->update($id, $stokbarangjadi);
        session()->setFlashData('pesan_edit', "Data Stok Barang Jadi Berhasil Diedit");
        return redirect()->to('StokBarangJadi');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new StokBarangJadiModel;
        $getStokBarangJadi = $model->getStokBarangJadi($id)->getRow();
        if (isset($getStokBarangJadi)) {
            $model->hapusstokbarangjadi($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/StokBarangJadi');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/StokBarangJadi');
        }
    }
}
