<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\AbsensiModel;


use App\Controllers\BaseController;
use App\Models\PresensiAdminModel;
use Config\Validation;

class Absensi extends BaseController
{
    public function index()
    {
        $model = new PegawaiModel;
        $Absensi = new AbsensiModel();
        $presensiAdmin = new PresensiAdminModel();
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getPegawai;
        }

        date_default_timezone_set('Asia/Jakarta');
        $all = $Absensi->countAll();
        $absensi['getPegawai'] = $model->getPegawai();
        $absensi['Absensi'] = $Absensi->getAllAbseni();
        $absensi['presensiAdmin'] = $presensiAdmin->getPresensi();
        $absensi['Hadir'] = $Absensi->countHadir();
        $absensi['Izin'] = $Absensi->countIzin();
        $absensi['All'] = $Absensi->countAll();
        // $absensi['Hadir'] = $count;
        $absensi['countAll'] = $Absensi->countAll();
        $absensi['title'] = 'Data Presensi';
        $absensi['date'] = date('l, j F Y');


        echo view('/absensi/absensiView', $absensi);
    }

    public function tambahPegawai()
    {
        session();
        $pegawai['validation'] = \Config\Services::validation();
        $pegawai['title'] = 'Tambah Data pegawai';
        return  view('/pegawai/tambahPegawaiView', $pegawai);
    }

    public function save()
    {
        $AbsensiModel = new AbsensiModel();
        $absen = [
            // 'id' => $this->request->getVar('id'),
            'id_pegawai' => $this->request->getVar('pegawai'),
            'tanggal_hadir' => $this->request->getVar('tanggal'),
            'status' => $this->request->getVar('status')
        ];
        // Ambil tanggal dan ID pegawai dari form
        $tanggal =  $this->request->getVar('tanggal');
        $pegawai =  $this->request->getVar('pegawai');
        // ambil data absensi berdasarkan tanggal dan id
        $existingAbsensi = $AbsensiModel->where('tanggal_hadir', $tanggal)
            ->where('id_pegawai', $pegawai)
            ->first();
        // Jika tanggal dan ID pegawai sudah ada
        if ($existingAbsensi) {
            session()->setFlashData('pesan_sudah_ada', "Tanggal / Nama Pegawai sudah ada");
            return redirect()->to('Absensi')->withInput();
        }
        $AbsensiModel->save($absen);
        session()->setFlashData('pesan_tambah', "Data Absen Berhasil Ditambah");
        return redirect()->to('Absensi');
    }
    // edit
    public function edit($id)
    {
        session();

        $PegawaiModel = new PegawaiModel;
        $getPegawai = $PegawaiModel->getPegawai($id)->getRow();

        if (isset($getPegawai)) {
            $pegawai = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Pegawai ' . $getPegawai->nama_pegawai,
            ];
            $pegawai['pegawai'] = $getPegawai;
            return view('/Pegawai/editPegawaiView', $pegawai);
        } else {
            session()->setFlashData('pesan_edit', 'Id Pegawai tidak ditemukan');
            return redirect()->to('/Pegawai');
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
            return redirect()->to('/Pegawai/update/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $PegawaiModel = new PegawaiModel;
        $pegawai = [
            'id_pegawai' => $id,
            'nama_pegawai' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'jabatan' => $this->request->getPost('jabatan')
        ];
        // dd($pegawai);
        $PegawaiModel->update($id, $pegawai);
        session()->setFlashData('pesan_edit', "Data Pegawai Berhasil Diedit");
        return redirect()->to('Pegawai');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new PegawaiModel;
        $getPegawai = $model->getPegawai($id)->getRow();
        if (isset($getPegawai)) {
            $model->hapuspegawai($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/Pegawai');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/Pegawair');
        }
    }
}
