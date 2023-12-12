<?php

namespace App\Controllers;

use App\Models\penggajianModel;


use App\Controllers\BaseController;
use Config\Validation;

class penggajian extends BaseController
{
    public function index()
    {
        $model = new PenggajianModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getpenggajian;
        }
        $penggajian['getPenggajian'] = $model->getpenggajianJoin();
        $penggajian['countIzin'] = $model->countIzin();
        $penggajian['title'] = 'Data penggajian';

        // Perulangan untuk menggabungkan array
        foreach ($penggajian['getPenggajian'] as $data) {
            if (!(empty($penggajian['countIzin']))) {
                $id = $data['id_pegawai'];
                $data['potongan'] = 0;
                $data['gaji'] = $data['gaji'] = $data['gaji_pokok'];
                $data['izin'] = 0;
                // Mencari data izin berdasarkan ID pegawai di array $countizin
                foreach ($penggajian['countIzin'] as $izin) {
                    if ($izin['id_pegawai'] == $id) {
                        // Menggabungkan data izin ke array $data
                        $data['izin'] = $izin['izin'];
                        if ($izin['izin'] < 2) {
                            $data['gaji'] = $data['gaji_pokok'];
                            $data['izin'] = $izin['izin'];
                            $data['potongan'] = 0;
                        } elseif ($izin['izin'] >= 3 && $izin['izin'] < 5) {
                            $potongan = $data['gaji_pokok'] * 0.03;
                            $gaji = $data['gaji_pokok'] - $potongan;
                            $data['potongan'] = $potongan;
                            $data['gaji'] = $gaji;
                            $data['izin'] = $izin['izin'];
                        } elseif ($izin['izin'] >= 5) {
                            $potongan = $data['gaji_pokok'] * 0.05;
                            $gaji = $data['gaji_pokok'] - $potongan;
                            $data['potongan'] = $potongan;
                            $data['gaji'] = $gaji;
                            $data['izin'] = $izin['izin'];
                        }
                        // break;
                    }
                }
            } else {
                $data['izin'] = 0;
                $data['potongan'] =  0;
                $data['gaji'] = $data['gaji_pokok'];
            }
            // Menambahkan data pegawai ke array hasil gabungan
            $gabung[] = $data;
        }

        $penggajian['gabung'] = $gabung;

        // dd($penggajian['gabung']);
        echo view('/penggajian/penggajianView', $penggajian);
    }

    public function tambahpenggajian()
    {
        session();
        $penggajian['validation'] = \Config\Services::validation();
        $penggajian['title'] = 'Tambah Data penggajian';
        return  view('/penggajian/tambahpenggajianView', $penggajian);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[pengajian . nama_pegawai]',
                'errors' => [
                    'required' => 'Nama pegawai  harus diisi',
                    'is_unique' => 'Nama pegawai sudah ada'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat pegawai stok harus diisi'
                ]
            ],
            'umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Umurpegawai harus diisi'
                ]
            ],
            'daerah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Daerah Operasi harus diisi'
                ]
            ],
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/penggajian/tambahpenggajian')->withInput()->with('validation', $validation);
        }
        $penggajianModel = new penggajianModel;
        $penggajian = [
            'title' => 'Tambah Datapenggajian',
            // 'id' => $this->request->getVar('id'),
            'nama_pegawai' => $this->request->getVar('nama'),
            'alamat_pegawai' => $this->request->getVar('alamat'),
            'umur_pegawai' => $this->request->getVar('umur'),
            'daerah_operasi' => $this->request->getVar('daerah')
        ];
        $penggajianModel->save($penggajian);
        session()->setFlashData('pesan_tambah', "Data penggajian Berhasil Ditambah");
        return redirect()->to('penggajian');
    }
    // edit
    public function edit($id)
    {
        session();
        $penggajianModel = new penggajianModel;
        $getpenggajian = $penggajianModel->getpenggajian($id)->getRow();

        if (isset($getpenggajian)) {
            $penggajian = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data penggajian ' . $getpenggajian->nama_pegawai,
            ];
            $penggajian['penggajian'] = $getpenggajian;
            return view('/penggajian/editpenggajianView', $penggajian);
        } else {
            session()->setFlashData('pesan_edit', 'Id pegawai tidak ditemukan');
            return redirect()->to('/penggajian');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pegawai  harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/penggajian/update/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $penggajianModel = new penggajianModel;
        $penggajian = [
            'id_pegawai' => $id,
            'nama_pegawai' => $this->request->getPost('nama'),
            'alamat_pegawai' => $this->request->getPost('alamat'),
            'umur_spegawai' => $this->request->getPost('umur'),
            'daerah_operasi' => $this->request->getPost('daerah')
        ];
        // dd($penggajian);
        $penggajianModel->update($id, $penggajian);
        session()->setFlashData('pesan_edit', "Data penggajian Berhasil Diedit");
        return redirect()->to('penggajian');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new penggajianModel;
        $getpenggajian = $model->getpenggajian($id)->getRow();
        if (isset($getpenggajian)) {
            $model->hapuspenggajian($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/penggajian');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/penggajian');
        }
    }
}
