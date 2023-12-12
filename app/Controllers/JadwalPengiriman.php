<?php

namespace App\Controllers;

use App\Models\JadwalPengirimanModel;


use App\Controllers\BaseController;
use App\Models\StokBarangJadiModel;
use App\Models\ArmadaModel;
use Config\Validation;

class JadwalPengiriman extends BaseController
{
    public function index()
    {
        $model = new JadwalPengirimanModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getJadwalPengirimanJoin();
        }
        $jadwalpengiriman = [
            'title' => 'Data Jadwal Pengiriman',
            'getJadwalPengiriman' => $model->getJadwalPengirimanJoin()

        ];
        // dd($jadwalpengiriman);
        echo view('/jadwal_pengiriman/jadwalpengirimanView', $jadwalpengiriman);
    }

    public function tambahJadwalPengiriman()
    {
        session();
        $supplierModel = new ArmadaModel();
        $bahanmentahModel = new StokBarangJadiModel();
        $jadwalpengiriman['armada'] = $supplierModel->getArmada();
        $jadwalpengiriman['stokbarangjadi'] = $bahanmentahModel->getStokBarangJadi();
        $jadwalpengiriman['validation'] = \Config\Services::validation();
        $jadwalpengiriman['title'] = 'Tambah Data JadwalPengiriman';
        return  view('/jadwal_pengiriman/Tambahjadwalpengirim', $jadwalpengiriman);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Pengiriman harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Tujuan harus diisi'
                ]
            ],
            'stokbarangjadi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id barang harus diisi'
                ]
            ],
            'armada' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id Sales harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pengiriman harus diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/JadwalPengiriman/tambahJadwalPengiriman')->withInput()->with('validation', $validation);
        }
        $JadwalPengirimanModel = new JadwalPengirimanModel();
        $jadwalpengiriman = [
            'title' => 'Tambah Data JadwalPengiriman',
            // 'id' => $this->request->getVar('id'),
            'nama_pengirim' => $this->request->getVar('nama'),
            'tanggal_pengiriman' => $this->request->getVar('tanggal'),
            'alamat_tujuan' => $this->request->getVar('alamat'),
            'id_barang' => $this->request->getVar('stokbarangjadi'),
            'plat_nomor' => $this->request->getVar('armada'),
            'jumlah_pengiriman' => $this->request->getVar('jumlah'),
            'status' => $this->request->getVar('status')
        ];
        // dd($jadwalpengiriman);
        $JadwalPengirimanModel->save($jadwalpengiriman);
        session()->setFlashData('pesan_tambah', "Data JadwalPengiriman Berhasil Ditambah");
        return redirect()->to('JadwalPengiriman');
    }
    // edit
    public function edit($id)
    {
        session();
        $JadwalPengirimanModel = new JadwalPengirimanModel();
        $ArmadaModel = new ArmadaModel();
        $StokBarangJadiModel = new StokBarangJadiModel();
        $getJadwalPengiriman = $JadwalPengirimanModel->getJadwalPengiriman($id)->getRow();

        if (isset($getJadwalPengiriman)) {
            $jadwalpengiriman = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Data JadwalPengiriman ' . $getJadwalPengiriman->id_pengirim,
            ];
            $jadwalpengiriman['jadwalpengiriman'] = $getJadwalPengiriman;
            $jadwalpengiriman['armada'] = $ArmadaModel->getArmada();
            $jadwalpengiriman['stokbarangjadi'] = $StokBarangJadiModel->getStokBarangJadi();


            return view('/jadwal_pengiriman/editView', $jadwalpengiriman);
        } else {
            session()->setFlashData('pesan_edit', 'Id JadwalPengiriman tidak ditemukan');
            return redirect()->to('/JadwalPengiriman');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Pengiriman harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Tujuan harus diisi'
                ]
            ],
            'stokbarangjadi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id barang harus diisi'
                ]
            ],
            'armada' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id Sales harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pengiriman harus diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/JadwalPengiriman/editView/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $JadwalPengirimanModel = new JadwalPengirimanModel();
        $jadwalpengiriman = [
            $id => $this->request->getPost('id'),
            'id_pengirim' => $id,
            'nama_pengirim' => $this->request->getVar('nama'),
            'tanggal_pengiriman' => $this->request->getVar('tanggal'),
            'alamat_tujuan' => $this->request->getVar('alamat'),
            'id_barang' => $this->request->getVar('stokbarangjadi'),
            'plat_nomor' => $this->request->getVar('armada'),
            'jumlah_pengiriman' => $this->request->getVar('jumlah'),
            'status' => $this->request->getVar('status')
        ];

        $JadwalPengirimanModel->update($id, $jadwalpengiriman);
        session()->setFlashData('pesan_edit', "Data JadwalPengiriman Berhasil Diedit");
        return redirect()->to('JadwalPengiriman');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new JadwalPengirimanModel();
        $getJadwalPengiriman = $model->getJadwalPengiriman($id)->getRow();
        if (isset($getJadwalPengiriman)) {
            $model->hapusJadwalPengiriman($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/JadwalPengiriman');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/JadwalPengiriman');
        }
    }
}
