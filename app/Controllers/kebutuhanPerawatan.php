<?php

namespace App\Controllers;

use App\Models\KebutuhanPerawatanModel;
use App\Models\AsetMesinModel;


use App\Controllers\BaseController;

use Config\Validation;

class KebutuhanPerawatan extends BaseController
{
    public function index()
    {
        $model = new KebutuhanPerawatanModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getKebutuhanPerawatanJoin();
        }
        $kebutuhanperawatan = [
            'title' => 'Data Kebutuhan Perawatan',
            'getKebutuhanPerawatan' => $model->getKebutuhanPerawatanJoin()

        ];
        echo view('/kebutuhan_perawatan/view', $kebutuhanperawatan);
    }

    public function tambah()
    {
        session();
        $asetmesinModel = new asetmesinModel();
        $kebutuhanperawatan['asetmesin'] = $asetmesinModel->getAsetMesin();
        $kebutuhanperawatan['validation'] = \Config\Services::validation();
        $kebutuhanperawatan['title'] = 'Tambah Data Kebutuhan Perawatan';
        return  view('/kebutuhan_perawatan/tambahView', $kebutuhanperawatan);
    }

    public function add()
    {
        if (!$this->validate([
            'asetmesin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Mesin  harus diisi'
                ]
            ],
            'kebutuhan_perawatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kebutuhan_perawatan harus diisi'
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
            return redirect()->to('/KebutuhanPerawatan/tambah')->withInput()->with('validation', $validation);
        }
        $KebutuhanPerawatanModel = new KebutuhanPerawatanModel();
        $kebutuhanperawatan = [
            'title' => 'Tambah Data Kebutuhan Perawatan',
            'id_mesin' => $this->request->getVar('asetmesin'),
            'kebutuhan_perawatan' => $this->request->getVar('kebutuhan_perawatan'),
            'status' => $this->request->getVar('status')
        ];
        $KebutuhanPerawatanModel->save($kebutuhanperawatan);
        session()->setFlashData('pesan_tambah', "Data Kebutuhan Perawatan Berhasil Ditambah");
        return redirect()->to('KebutuhanPerawatan');
    }
    // edit
    public function edit($id)
    {
        session();
        $KebutuhanPerawatanModel = new KebutuhanPerawatanModel();
        $AsetMesinModel = new AsetMesinModel();
        $getKebutuhanPerawatan = $KebutuhanPerawatanModel->getKebutuhanPerawatan($id)->getRow();
        $getAsetMesin = $AsetMesinModel->getAsetMesin($id)->getRow();
        if (isset($getKebutuhanPerawatan)) {
            $kebutuhanperawatan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Kebutuhan Perawatan ' . $getKebutuhanPerawatan->id_mesin,
                'kebutuhanperawatan' => $getKebutuhanPerawatan,
                'asetmesin' => $AsetMesinModel->getAsetMesin()
            ];
            return view('/kebutuhan_perawatan/editView', $kebutuhanperawatan);
        } else {
            session()->setFlashData('pesan_edit', 'Id kebutuhan Perawatan tidak ditemukan');
            return redirect()->to('/KebutuhanPerawatan');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'asetmesin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Mesin harus diisi'
                ]
            ],
            'kebutuhan_perawatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kebutuhan_perawatan harus diisi'
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
            return redirect()->to('/KebutuhanPerawatan/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $KebutuhanPerawatanModel = new KebutuhanPerawatanModel();
        $kebutuhanperawatan = [
            $id => $this->request->getPost('id'),
            'id_kebutuhan_perawatan' => $id,
            'id_mesin' => $this->request->getPost('asetmesin'),
            'kebutuhan_perawatan' => $this->request->getPost('kebutuhan_perawatan'),
            'status' => $this->request->getVar('status')
        ];
        $KebutuhanPerawatanModel->update($id, $kebutuhanperawatan);
        session()->setFlashData('pesan_edit', "Data Kebutuhan Perawatan Berhasil Diedit");
        return redirect()->to('KebutuhanPerawatan');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new KebutuhanPerawatanModel();
        $getKebutuhanPerawatan = $model->getKebutuhanPerawatan($id)->getRow();
        if (isset($getKebutuhanPerawatan)) {
            $model->delete($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/KebutuhanPerawatan');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/KebutuhanPerawatan');
        }
    }
}
