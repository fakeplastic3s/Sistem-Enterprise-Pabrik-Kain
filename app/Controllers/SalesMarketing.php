<?php

namespace App\Controllers;

use App\Models\SalesMarketingModel;


use App\Controllers\BaseController;
use Config\Validation;

class SalesMarketing extends BaseController
{
    public function index()
    {
        $model = new SalesMarketingModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getSalesMarketing;
        }
        $salesmarketing['getSalesMarketing'] = $model->getSalesMarketing();
        $salesmarketing['title'] = 'Data Sales Marketing';
        echo view('/sales_marketing/SalesMarketingView', $salesmarketing);
    }

    public function tambahSalesMarketing()
    {
        session();
        $salesmarketing['validation'] = \Config\Services::validation();
        $salesmarketing['title'] = 'Tambah Data sales marketing';
        return  view('/sales_marketing/tambahSalesMarketingView', $salesmarketing);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[sales_marketing . nama_sales]',
                'errors' => [
                    'required' => 'Nama sales  harus diisi',
                    'is_unique' => 'Nama sales sudah ada'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Sales stok harus diisi'
                ]
            ],
            'umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Umur Sales harus diisi'
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
            return redirect()->to('/SalesMarketing/tambahsalesmarketing')->withInput()->with('validation', $validation);
        }
        $salesmarketingModel = new SalesMarketingModel;
        $salesmarketing = [
            'title' => 'Tambah Data Sales Marketing',
            // 'id' => $this->request->getVar('id'),
            'nama_sales' => $this->request->getVar('nama'),
            'alamat_sales' => $this->request->getVar('alamat'),
            'umur_sales' => $this->request->getVar('umur'),
            'daerah_operasi' => $this->request->getVar('daerah')
        ];
        $salesmarketingModel->save($salesmarketing);
        session()->setFlashData('pesan_tambah', "Data Sales Marketing Berhasil Ditambah");
        return redirect()->to('SalesMarketing');
    }
    // edit
    public function edit($id)
    {
        session();
        $SalesMarketingModel = new SalesMarketingModel;
        $getSalesMarketing = $SalesMarketingModel->getSalesMarketing($id)->getRow();

        if (isset($getSalesMarketing)) {
            $salesmarketing = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data SalesMarketing ' . $getSalesMarketing->nama_sales,
            ];
            $salesmarketing['sales_marketing'] = $getSalesMarketing;
            return view('/sales_marketing/editSalesMarketingView', $salesmarketing);
        } else {
            session()->setFlashData('pesan_edit', 'Id slaes tidak ditemukan');
            return redirect()->to('/salesmarketing');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama sales  harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/SalesMarketing/update/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $SalesMarketingModel = new SalesMarketingModel;
        $salesmarketing = [
            'id_sales' => $id,
            'nama_sales' => $this->request->getPost('nama'),
            'alamat_sales' => $this->request->getPost('alamat'),
            'umur_sales' => $this->request->getPost('umur'),
            'daerah_operasi' => $this->request->getPost('daerah')
        ];
        // dd($salesmarketing);
        $SalesMarketingModel->update($id, $salesmarketing);
        session()->setFlashData('pesan_edit', "Data Sales Marketing Berhasil Diedit");
        return redirect()->to('SalesMarketing');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new SalesMarketingModel;
        $getSalesmarketing = $model->getSalesMarketing($id)->getRow();
        if (isset($getSalesMarketing)) {
            $model->hapussalessmarketing($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/SalesMarketing');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/SalesMarketing');
        }
    }
}
