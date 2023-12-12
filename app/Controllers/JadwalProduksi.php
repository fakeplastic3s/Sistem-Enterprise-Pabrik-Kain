<?php

namespace App\Controllers;

use App\Models\JadwalProduksiModel;


use App\Controllers\BaseController;
use App\Models\KebutuhanProduksiModel;
use App\Models\StokBarangJadiModel;
use Config\Validation;

class JadwalProduksi extends BaseController
{
    public function index()
    {
        $model = new JadwalProduksiModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getJadwalProduksiJoin();
        }
        $jadwalproduksi = [
            'title' => 'Data Jadwal Produksi',
            'getJadwalProduksi' => $model->getJadwalProduksiJoin()

        ];
        // dd($bahanmasuk);
        echo view('/jadwal_produksi/jadwalproduksiView', $jadwalproduksi);
    }

    public function tambahJadwalProduksi()
    {
        session();
        $kebutuhanproduksiModel = new KebutuhanProduksiModel();
        $jadwalproduksi['kebutuhan'] = $kebutuhanproduksiModel->getKebutuhanProduksi();
        $jadwalproduksi['validation'] = \Config\Services::validation();
        $jadwalproduksi['title'] = 'Tambah Data Jadwal Produksi';
        return  view('/jadwal_produksi/tambahView', $jadwalproduksi);
    }

    public function add()
    {
        if (!$this->validate([
            'barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama bahan  harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'jam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/JadwalProduksi/tambahJadwalProduksi')->withInput()->with('validation', $validation);
        }
        $JadwalProduksiModel = new JadwalProduksiModel();
        $jadwalproduksi = [
            'title' => 'Tambah Jadwal Produksi',
            'id_kebutuhan_produksi' => $this->request->getVar('barang'),
            'tanggal_produksi' => $this->request->getVar('tanggal'),
            'jam_produksi' => $this->request->getVar('jam')
        ];
        // dd($jadwalproduksi);
        $JadwalProduksiModel->insert($jadwalproduksi);
        session()->setFlashData('pesan_tambah', "Data Jadwal Produksi Berhasil Ditambah");
        return redirect()->to('JadwalProduksi');
    }
    // edit
    public function edit($id)
    {
        session();
        $JadwalProduksiModel = new JadwalProduksiModel();
        $kebutuhanproduksiModel = new KebutuhanProduksiModel();
        $getJadwalProduksi = $JadwalProduksiModel->getJadwalProduksi($id)->getRow();

        if (isset($getJadwalProduksi)) {
            $jadwalproduksi = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Jadwal Produksi ' . $getJadwalProduksi->tanggal_produksi,
            ];
            $jadwalproduksi['jadwalproduksi'] = $getJadwalProduksi;
            $jadwalproduksi['kebutuhan'] = $kebutuhanproduksiModel->getKebutuhanProduksi();


            return view('/jadwal_produksi/editView', $jadwalproduksi);
        } else {
            session()->setFlashData('pesan_edit', 'Id produksi tidak ditemukan');
            return redirect()->to('/JadwalProduksi');
        }
    }

    public function update($id)
    {
        $JadwalProduksiModel = new JadwalProduksiModel();
        $jadwalproduksi = [
            $id => $this->request->getPost('id'),
            'id_produksi' => $id,
            'id_kebutuhan_produksi' => $this->request->getVar('barang'),
            'tanggal_produksi' => $this->request->getVar('tanggal'),
            'jam_produksi' => $this->request->getPost('jam')
        ];
        // dd($jadwalproduksi);
        $JadwalProduksiModel->update($id, $jadwalproduksi);
        session()->setFlashData('pesan_edit', "Data Jadwal Produksi Berhasil Diedit");
        return redirect()->to('JadwalProduksi');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new JadwalProduksiModel();
        $getJadwalProduksi = $model->getJadwalProduksi($id)->getRow();
        if (isset($getJadwalProduksi)) {
            $model->hapusJadwalProduksi($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/JadwalProduksi');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/JadwalProduksi');
        }
    }
}
