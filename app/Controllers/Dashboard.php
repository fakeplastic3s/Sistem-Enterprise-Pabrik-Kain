<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\BaseController;
use App\Models\AbsensiAdminModel;
use App\Models\BahanMasukModel;
use App\Models\BahanMentahModel;
use App\Models\BahanTerpakaiModel;
use App\Models\HasilProduksiModel;
use App\Models\JadwalProduksiModel;
use App\Models\KebutuhanPerawatanModel;
use App\Models\KebutuhanProduksiModel;
use App\Models\PengadaanBahanModel;
use App\Models\PenjualanModel;
use App\Models\PresensiAdminModel;
use App\Models\SalesMarketingModel;
use App\Models\StokBarangJadiModel;
use App\Models\SupplierModel;

// use CodeIgniter\I18n\Time;
// use CodeIgniter\I18n\Calendar;
// use CodeIgniter\Calendar\Calendar;


class Dashboard extends BaseController
{
    public function index()
    {
        $presensi = new PresensiAdminModel();
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'title' => 'Dashboard',
            'date' => date('l, j F Y'),
            'today' => date('Y-m-d'),
        ];
        // Ambil data username dan email dari session
        $username =  session()->get('user_name');
        $email = session()->get('user_email');
        $date = date('Y-m-d');

        // ambil data presensi berdasarkan tanggal dan id
        $existingPresensi = $presensi->where('username', $username)
            ->where('user_email', $email)
            ->where('tanggal_presensi', $date)
            ->first();



        if ($existingPresensi) {
            $session->remove('pesan_belum_presensi');
            echo view('index', $data);
        } else {
            session()->setFlashData('pesan_belum_presensi', "Hallo, " . $username . ". Kamu Belum Melakukan Presensi Hari Ini");
            echo view('index', $data);
        }
    }
    public function indexSupplier()
    {

        $session = session();
        $bahanmentah = new BahanMentahModel();
        $pengadaan = new PengadaanBahanModel();
        $supplier = new SupplierModel();
        $presensiSupplier = new PresensiAdminModel();
        // $this->load->library('calendar');
        // $calendar = $this->load->library('calendar');
        // $calendar->setDate(date('Y'), date('m'), date('d'));


        // // Set waktu dan zona waktu dari hari ini
        // $now = new Time('now', 'Asia/Jakarta');

        // // Buat instance dari Calendaring Class
        // $cal = new Calendar('id_ID', $now);

        // // Generate kalender dengan Calendaring Class
        // $calendar =
        date_default_timezone_set('Asia/Jakarta');
        // setlocale(LC_ALL, 'id_ID');

        $data = [
            'title' => 'Dashboard',
            'bahanmentah' => $bahanmentah->getBahanMentah(),
            'diajukan' => $pengadaan->getPengadaanJoinDiajukan(),
            'disetujui' => $pengadaan->getPengadaanJoinDisetujui(),
            'ditolak' => $pengadaan->getPengadaanJoinDitolak(),
            'supplier' => $supplier->countSupplier(),
            'date' => date('l, j F Y'),
            'today' => date('Y-m-d'),
            // 'date' => strftime("%A, %d %B %Y"),
            // 'time' => date('h:i:s')
            // 'calendar' => $cal->generate($now->getYear(), $now->getMonth())
        ];

        $bahanmentah = $bahanmentah->getBahanMentah();
        // Notifikasi jika stok bahan mentah kurang dari 5
        foreach ($bahanmentah as $isi) {
            if ($isi['jumlah_stok'] <= 5) {
                session()->setFlashData('notifikasi' . $isi['id_bahan_mentah'], $isi['nama_bahan_mentah'] . " Hampir Habis, Silahkan Cek Data Stok Bahan");
            }
        }

        $getData = $presensiSupplier->getPresensi();

        // Ambil data username dan email dari session
        $username =  session()->get('user_name');
        $email = session()->get('user_email');
        $date = date('Y-m-d');

        // dd($date);

        // ambil data presensi berdasarkan tanggal dan id
        $existingPresensi = $presensiSupplier->where('username', $username)
            ->where('user_email', $email)
            ->where('tanggal_presensi', $date)
            ->first();

        if ($existingPresensi) {
            $session->remove('pesan_belum_presensi');
            echo view('Dashboard/indexSupplier', $data);
        } else {
            session()->setFlashData('pesan_belum_presensi', "Hallo, " . $username . ". Kamu Belum Melakukan Presensi Hari Ini");
            echo view('Dashboard/indexSupplier', $data);
        }
    }
    public function indexGudang()
    {

        $session = session();

        $bahanmentah = new BahanMentahModel();
        $bahanmasuk = new BahanMasukModel();
        $bahanterpakai = new BahanTerpakaiModel();
        $stokbarangjadi = new StokBarangJadiModel();
        $presensiGudang = new PresensiAdminModel();

        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'title' => 'Dashboard',
            'bahanmentah' => $bahanmentah->getBahanMentah(),
            'bahanmasuk' => $bahanmasuk->getBahanMasukJoin(),
            'laporanperBulan' => $bahanmasuk->laporanperBulan(),
            'bahanterpakai' => $bahanterpakai->getBahanTerpakaiJoin(),
            'terpakaiperBulan' => $bahanterpakai->laporanperBulan(),
            'stokbarangjadi' => $stokbarangjadi->getStokBarangJadi(),
            'bahanmentah' => $bahanmentah->getBahanMentah(),
            'date' => date('l, j F Y'),
            'today' => date('Y-m-d'),

        ];

        // Ambil data username dan email dari session
        $username =  session()->get('user_name');

        $email = session()->get('user_email');
        $date = date('Y-m-d');
        // ambil data presensi berdasarkan tanggal dan id
        $existingPresensi = $presensiGudang->where('username', $username)
            ->where('user_email', $email)
            ->where('tanggal_presensi', $date)
            ->first();
        // Pengecekan apakah admin sudah absen pada hari itu atau belum
        if ($existingPresensi) {
            $session->remove('pesan_belum_presensi');
            echo view('Dashboard/indexGudang', $data);
        } else {
            session()->setFlashData('pesan_belum_presensi', "Hallo, " . $username . ". Kamu Belum Melakukan Presensi Hari Ini");
            echo view('Dashboard/indexGudang', $data);
        }
    }

    public function indexProduksi()
    {

        $session = session();
        $hasilproduksi = new HasilProduksiModel();
        $jadwal = new JadwalProduksiModel();
        $kebutuhan = new KebutuhanProduksiModel();
        $presensiProduksi = new PresensiAdminModel();


        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'title' => 'Dashboard',
            'hasil' => $hasilproduksi->sumJumlahProduksi(),
            'jadwal' => $jadwal->getJadwalProduksiJoin(),
            'kebutuhan' => $kebutuhan->getKebutuhanProduksi(),
            'date' => date('l, j F Y'),
            'today' => date('Y-m-d'),
        ];
        // Ambil data username dan email dari session
        $username =  session()->get('user_name');
        $email = session()->get('user_email');
        $date = date('Y-m-d');
        // ambil data presensi berdasarkan tanggal dan id
        $existingPresensi = $presensiProduksi->where('username', $username)
            ->where('user_email', $email)
            ->where('tanggal_presensi', $date)
            ->first();

        if ($existingPresensi) {
            $session->remove('pesan_belum_presensi');
            echo view('Dashboard/indexProduksi', $data);
        } else {

            session()->setFlashData('pesan_belum_presensi', "Hallo, " . $username . ". Kamu Belum Melakukan Presensi Hari Ini");
            echo view('Dashboard/indexProduksi', $data);
        }
    }
    public function indexKeuangan()
    {

        $session = session();
        $pengadaan = new PengadaanBahanModel();
        $perawatan = new KebutuhanPerawatanModel();
        $presensiAdmin = new PresensiAdminModel();

        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'title' => 'Dashboard',
            'diajukan' => $pengadaan->countDiajukan(),
            'disetujui' => $pengadaan->countDisetujui(),
            'ditolak' => $pengadaan->countDitolak(),
            'diajukanPerawatan' => $perawatan->countDiajukan(),
            'disetujuiPerawatan' => $perawatan->countDisetujui(),
            'ditolakPerawatan' => $perawatan->countDitolak(),
            'date' => date('l, j F Y'),
            'today' => date('Y-m-d'),
        ];
        // Ambil data username dan email dari session
        $username =  session()->get('user_name');
        $email = session()->get('user_email');
        $date = date('Y-m-d');
        // ambil data presensi berdasarkan tanggal dan id
        $existingPresensi = $presensiAdmin->where('username', $username)
            ->where('user_email', $email)
            ->where('tanggal_presensi', $date)
            ->where('status', 'Hadir')
            ->first();

        if ($existingPresensi) {
            $session->remove('pesan_belum_presensi');
            echo view('Dashboard/indexKeuangan', $data);
        } else {
            session()->setFlashData('pesan_belum_presensi', "Hallo, " . $username . ". Kamu Belum Melakukan Presensi Hari Ini");
            echo view('Dashboard/indexKeuangan', $data);
        }
    }
    public function indexPemasaran()
    {

        $session = session();

        $penjualan = new PenjualanModel();
        $sales = new SalesMarketingModel();
        $presensiAdmin = new PresensiAdminModel();

        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'title' => 'Dashboard',
            'jumlahpenjualan' => $penjualan->sumPenjualan(),
            'sales' => $sales->countSales(),
            'date' => date('l, j F Y'),
            'today' => date('Y-m-d'),
        ];
        // Ambil data username dan email dari session
        $username =  session()->get('user_name');
        $email = session()->get('user_email');
        $date = date('Y-m-d');
        // ambil data presensi berdasarkan tanggal dan id
        $existingPresensi = $presensiAdmin->where('username', $username)
            ->where('user_email', $email)
            ->where('tanggal_presensi', $date)
            ->first();

        if ($existingPresensi) {
            $session->remove('pesan_belum_presensi');
            echo view('Dashboard/indexPemasaran', $data);
        } else {
            session()->setFlashData('pesan_belum_presensi', "Hallo, " . $username . ". Kamu Belum Melakukan Presensi Hari Ini");
            echo view('Dashboard/indexPemasaran', $data);
        }
    }



    public function profil()
    {
        $data = [
            'title' => 'Profil',
        ];
        return view('pages/detailProfilView', $data);
    }
}
