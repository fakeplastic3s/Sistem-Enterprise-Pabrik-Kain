<?php

namespace App\Controllers;

use App\Models\PengadaanBahanModel;


use App\Controllers\BaseController;
use App\Models\SupplierModel;
use Config\Validation;

class AnggaranPengadaanBahan extends BaseController
{
    public function index()
    {
        $model = new PengadaanBahanModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getPengadaanJoin();
        }

        $pengadaan['getPengadaan'] = $model->getPengadaanJoin();
        $pengadaan['title'] = 'Data Anggaran Pengadaan Bahan';
        echo view('/anggaran_pengadaan_bahan/anggaranpengadaanView', $pengadaan);
    }


    public function proses($id)
    {
        session();
        $SupplierModel = new SupplierModel;
        $model = new PengadaanBahanModel();
        $getPengadaan = $model->getPengadaan($id)->getRow();

        if (isset($getPengadaan)) {
            $pengadaan = [
                'validation' => \Config\Services::validation(),
                'title' => 'Proses Data Anggaran Pengadaan Bahan ' . $getPengadaan->id_pengadaan,
            ];
            $pengadaan['supplier'] = $SupplierModel->getSupplier();
            $pengadaan['pengadaan'] = $getPengadaan;
            $pengadaan['status'] = $model->getPengadaan();
            return view('/anggaran_pengadaan_bahan/prosesView', $pengadaan);
        } else {
            session()->setFlashData('pesan_edit', 'Id Pengadaaan Bahan tidak ditemukan');
            return redirect()->to('/AnggaranPengadaanBahan');
        }
    }

    public function update($id)
    {
        $PengadaanModel = new PengadaanBahanModel();
        $pengadaan = [
            'id_supplier' => $id,
            'id_supplier' => $this->request->getPost('supplier'),
            'tanggal_pengadaan' => $this->request->getPost('tanggal'),
            'jumlah' => $this->request->getPost('jumlah'),
            'status' => $this->request->getPost('status'),
        ];
        // dd($pengadaan);
        $PengadaanModel->update($id, $pengadaan);
        session()->setFlashData('pesan_edit', "Data Pengadaan Bahan Berhasil Diproses");
        return redirect()->to('AnggaranPengadaanBahan');
    }
}
