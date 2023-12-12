<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\PresensiAdminModel;


use App\Controllers\BaseController;
use App\Models\AbsensiAdminModel;
use Config\Validation;

class PresensiAdmin extends BaseController
{


    public function admin()
    {
        session();
        $PresensiAdmin = new PresensiAdminModel();
        $dataAdmin = [
            'username' => $this->request->getPost('username'),
            'user_email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'tanggal_presensi' => $this->request->getPost('tanggal')
        ];
        $username = $this->request->getPost('username');
        $PresensiAdmin->save($dataAdmin);
        session()->setFlashData('pesan_presensi', "Terima Kasih " . $username . " Sudah Melakukan Presensi");
        return redirect()->to('Dashboard');
    }
    public function adminGudang()
    {
        session();
        $PresensiAdmin = new PresensiAdminModel();
        $dataAdmin = [
            'username' => $this->request->getPost('username'),
            'user_email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'tanggal_presensi' => $this->request->getPost('tanggal')
        ];
        $username = $this->request->getPost('username');
        $PresensiAdmin->save($dataAdmin);
        session()->setFlashData('pesan_presensi', "Terima Kasih " . $username . " Sudah Melakukan Presensi");
        return redirect()->to('Dashboard/indexGudang');
    }
    public function adminSupplier()
    {
        session();
        $PresensiAdmin = new PresensiAdminModel();
        $dataAdmin = [
            'username' => $this->request->getPost('username'),
            'user_email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'tanggal_presensi' => $this->request->getPost('tanggal')

        ];
        $username = $this->request->getPost('username');
        $PresensiAdmin->save($dataAdmin);
        session()->setFlashData('pesan_presensi', "Terima Kasih " . $username . " Sudah Melakukan Presensi");
        return redirect()->to('Dashboard/indexSupplier');
    }
    public function adminProduksi()
    {
        session();
        $PresensiAdmin = new PresensiAdminModel();
        $dataAdmin = [
            'username' => $this->request->getPost('username'),
            'user_email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'tanggal_presensi' => $this->request->getPost('tanggal')

        ];
        $username = $this->request->getPost('username');
        $PresensiAdmin->save($dataAdmin);
        session()->setFlashData('pesan_presensi', "Terima Kasih " . $username . " Sudah Melakukan Presensi");
        return redirect()->to('Dashboard/indexProduksi');
    }

    public function adminKeuangan()
    {
        session();
        $PresensiAdmin = new PresensiAdminModel();
        $dataAdmin = [
            'username' => $this->request->getPost('username'),
            'user_email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'tanggal_presensi' => $this->request->getPost('tanggal')

        ];
        $username = $this->request->getPost('username');
        $PresensiAdmin->save($dataAdmin);
        session()->setFlashData('pesan_presensi', "Terima Kasih " . $username . " Sudah Melakukan Presensi");
        return redirect()->to('Dashboard/indexKeuangan');
    }
    public function adminPemasaran()
    {
        session();
        $PresensiAdmin = new PresensiAdminModel();
        $dataAdmin = [
            'username' => $this->request->getPost('username'),
            'user_email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'tanggal_presensi' => $this->request->getPost('tanggal')

        ];
        $username = $this->request->getPost('username');
        $PresensiAdmin->save($dataAdmin);
        session()->setFlashData('pesan_presensi', "Terima Kasih " . $username . " Sudah Melakukan Presensi");
        return redirect()->to('Dashboard/indexPemasaran');
    }
}
