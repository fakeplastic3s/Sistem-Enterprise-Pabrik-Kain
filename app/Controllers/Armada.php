<?php

namespace App\Controllers;

use App\Models\ArmadaModel;
use App\Models\SupplierModel;


use App\Controllers\BaseController;
use Config\Validation;

class Armada extends BaseController
{
    public function index()
    {
        $model = new ArmadaModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $search = $model->search($keyword);
        } else {
            $model->getArmada();
        }
        // dd($search);
        $Armada['dataKendaraan'] = $model->getArmada();
        $Armada['title'] = 'Data Armada';
        // dd($Armada);
        echo view('Armada/Armadaview', $Armada);
    }

    public function tambahArmada()
    {
        session();
        $model = new ArmadaModel;
        $Armada['validation'] = \Config\Services::validation();
        $Armada['title'] = 'Tambah Data Armada ';
        return view('Armada/tambahArmada', $Armada);
    }

    public function add()
    {
        if (
            !$this->validate([
                'plat_nomor' => [
                    'rules' => 'required|is_unique[armada.plat_nomor]',
                    'errors' => [
                        'required' => 'Plat nomor harus diisi',
                        'is_unique' => 'Plat nomor sudah ada'
                    ]
                ],
                'jenis_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kendaraan harus diisi'
                    ]
                ],
                'umur_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Umur kendaraan harus diisi'
                    ]
                ],
            ])
        ) {
            return redirect()->to('/Armada/tambahArmada')->withInput();
        }
        $ArmadaModel = new ArmadaModel;
        $Armada = [
            'plat_nomor' => $this->request->getVar('plat_nomor'),
            'jenis_kendaraan' => $this->request->getVar('jenis_kendaraan'),
            'umur_kendaraan' => $this->request->getVar('umur_kendaraan'),
        ];
        $ArmadaModel->insert($Armada);
        session()->setFlashData('pesan_tambah', "Data berhasil ditambahkan");
        return redirect()->to('/Armada');
    }
    // edit
    public function edit($id)
    {
        $model = new ArmadaModel;
        $Armada['validation'] = \Config\Services::validation();
        $Armada['title'] = 'Edit Data Armada ';
        $Armada['data'] = $model->getArmada($id);
        return view('Armada/editArmada', $Armada);
    }

    public function update($id)
    {
        if (
            !$this->validate([
                'plat_nomor' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Plat nomor harus diisi',
                    ]
                ],
                'jenis_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kendaraan harus diisi'
                    ]
                ],
                'umur_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Umur kendaraan harus diisi'
                    ]
                ]
            ])
        ) {
            return redirect()->to('/Armada/edit/' . $id)->withInput();
        }
        $ArmadaModel = new ArmadaModel;
        $Armada = [
            'plat_nomor' => $this->request->getVar('plat_nomor'),
            'jenis_kendaraan' => $this->request->getVar('jenis_kendaraan'),
            'umur_kendaraan' => $this->request->getVar('umur_kendaraan'),
        ];
        $ArmadaModel->update($id, $Armada);
        session()->setFlashData('pesan_edit', "Data berhasil diubah");
        return redirect()->to('/Armada');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new ArmadaModel;
        $model->delete($id);
        session()->setFlashData('pesan_hapus', "Data Armada Berhasil Dihapus");
        return redirect()->to('Armada');
    }
}
