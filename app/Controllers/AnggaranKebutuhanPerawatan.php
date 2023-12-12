<?php

namespace App\Controllers;

use App\Models\KebutuhanPerawatanModel;


use App\Controllers\BaseController;
use App\Models\AsetMesinModel;
use Config\Validation;

class AnggaranKebutuhanPerawatan extends BaseController
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
        $kebutuhanperawatan['getKebutuhanPerawatan'] = $model->getKebutuhanPerawatanJoin();
        $kebutuhanperawatan['title'] = 'Data Anggaran Kebutuhan Perawatan';
        echo view('/anggaran_kebutuhan_perawatan/anggaranperawatanView', $kebutuhanperawatan);
    }


    public function proses($id)
    {
        session();
        $AsetMesinModel = new AsetMesinModel;
        $model = new KebutuhanPerawatanModel();
        $getKebutuhanPerawatan = $model->getKebutuhanPerawatan($id)->getRow();

        if (isset($getKebutuhanPerawatan)) {
            $kebutuhanperawatan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Proses Data Anggaran Kebutuhan Perawatan ' . $getKebutuhanPerawatan->id_kebutuhan_perawatan,
            ];
            $kebutuhanperawatan['asetmesin'] = $AsetMesinModel->getAsetMesin();
            $kebutuhanperawatan['kebutuhanperawatan'] = $getKebutuhanPerawatan;
            $kebutuhanperawatan['status'] = $model->getKebutuhanPerawatan();
            return view('/anggaran_kebutuhan_perawatan/prosesView', $kebutuhanperawatan);
        } else {
            session()->setFlashData('pesan_edit', 'Id Kebutuhan Perawatan tidak ditemukan');
            return redirect()->to('/AnggaranKebutuhanPerawatan');
        }
    }

    public function update($id)
    {
        $KebutuhanPerawatanModel = new KebutuhanPerawatanModel();
        $kebutuhanperawatan = [
            'id_kebutuhan_perawatan' => $id,
            'id_mesin' => $this->request->getPost('asetmesin'),
            'kebutuhan_perawatan' => $this->request->getPost('kebutuhan_perawatan'),
            'status' => $this->request->getVar('status')
        ];

        $KebutuhanPerawatanModel->update($id, $kebutuhanperawatan);
        session()->setFlashData('pesan_edit', "Data Kebutuhan Perawatan Berhasil Diproses");
        return redirect()->to('AnggaranKebutuhanPerawatan');
    }
}
