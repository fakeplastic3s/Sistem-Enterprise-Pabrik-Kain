<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanMasukModel;
use App\Models\PenjualanModel;
use App\Models\BahanMentahModel;
use App\Models\StokBarangJadiModel;

class Laporan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Penjualan'
        ];
        //
        return view('laporan/index', $data);
    }

    public function cetakPenjualanPeriode()
    {
        $tglawal = $this->request->getVar('tglawal');
        $tglakhir = $this->request->getVar('tglakhir');

        $Penjualan = new PenjualanModel();
        $dataLaporan = $Penjualan->laporanPerPeriode($tglawal, $tglakhir);
        $laporan = $dataLaporan->getResultArray();
        // dd($laporan);

        $data = [
            'title' => 'Laporan Pengunjung',
            'datalaporan' => $dataLaporan,
            'laporan' => $laporan,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir
        ];
        //
        return view('laporan/cetakLaporanPenjualan', $data);
    }
    public function bahanmentah()
    {
        $model = new BahanMentahModel;
        $bahanmasuk = new BahanMasukModel();
        $bahanmentah = [
            'title' => 'Laporan Bahan Mentah',
            'getBahanMentah' => $model->getBahanMentah(),
            'lastDate' => $bahanmasuk->lastDate()

        ];
        echo view('/laporan/laporanbahanmentahView', $bahanmentah);
    }

    public function barangjadi()
    {
        $model = new StokBarangJadiModel();
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getStokBarangJadi;
        }
        $stokbarangjadi['getStokBarangJadi'] = $model->getStokBarangJadi();
        $stokbarangjadi['title'] = 'Data Stok Barang Jadi';
        echo view('/laporan/laporanbarangjadiView', $stokbarangjadi);
    }
}
