<?php

namespace App\Controllers;

use App\Models\SupplierModel;


use App\Controllers\BaseController;
use Config\Validation;

class Supplier extends BaseController
{
    public function index()
    {
        $model = new SupplierModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getSupplier;
        }
        $supplier['getSupplier'] = $model->getSupplier();
        $supplier['title'] = 'Data Supplier';
        echo view('/supplier/SupplierView', $supplier);
    }

    public function tambahSupplier()
    {
        session();
        $supplier['validation'] = \Config\Services::validation();
        $supplier['title'] = 'Tambah Data Supplier';
        return  view('/supplier/tambahSupplierView', $supplier);
    }

    public function add()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[supplier . nama_supplier]',
                'errors' => [
                    'required' => 'Nama supplier  harus diisi',
                    'is_unique' => 'Nama supplier sudah ada'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/Supplier/tambahSupplier')->withInput()->with('validation', $validation);
        }
        $SupplierModel = new SupplierModel;
        $supplier = [
            'title' => 'Tambah DataSupplier',
            // 'id' => $this->request->getVar('id'),
            'nama_supplier' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga_satuan' => $this->request->getVar('harga')
        ];
        $SupplierModel->save($supplier);
        session()->setFlashData('pesan_tambah', "Data Supplier Berhasil Ditambah");
        return redirect()->to('Supplier');
    }
    // edit
    public function edit($id)
    {
        session();
        $SupplierModel = new SupplierModel;
        $getSupplier = $SupplierModel->getSupplier($id)->getRow();

        if (isset($getSupplier)) {
            $supplier = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data Supplier ' . $getSupplier->nama_supplier,
            ];
            $supplier['supplier'] = $getSupplier;
            return view('/Supplier/editSupplierView', $supplier);
        } else {
            session()->setFlashData('pesan_edit', 'Id supplier tidak ditemukan');
            return redirect()->to('/Supplier');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama supplier  harus diisi',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/Supplier/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $SupplierModel = new SupplierModel;
        $supplier = [
            'id_supplier' => $id,
            'nama_supplier' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_satuan' => $this->request->getVar('harga')
        ];
        // dd($supplier);
        $SupplierModel->update($id, $supplier);
        session()->setFlashData('pesan_edit', "Data Supplier Berhasil Diedit");
        return redirect()->to('Supplier');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new SupplierModel;
        $getSupplier = $model->getSupplier($id)->getRow();
        if (isset($getSupplier)) {
            $model->hapussupplier($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/Supplier');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/Supplier');
        }
    }
}
