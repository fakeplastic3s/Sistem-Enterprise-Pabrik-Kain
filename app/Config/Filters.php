<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Auth;
use App\Filters\FilterSupplier;
use App\Filters\FilterGudang;
use App\Filters\FilterProduksi;
use App\Filters\FilterPengiriman;
use App\Filters\FilterPemasaran;
use App\Filters\FilterKeuangan;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'                          => CSRF::class,
        'toolbar'                       => DebugToolbar::class,
        'honeypot'                      => Honeypot::class,
        'Auth'                          => Auth::class,
        'FilterSupplier'                => FilterSupplier::class,
        'FilterGudang'                  => FilterGudang::class,
        'FilterProduksi'                => FilterProduksi::class,
        'FilterPengiriman'              => FilterPengiriman::class,
        'FilterPemasaran'              => FilterPemasaran::class,
        'FilterKeuangan'              => FilterKeuangan::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'Auth' => ['except' => ['login', 'login/*', 'register', 'register/*', 'LandingPage', 'LandingPage/*', '/']],

        ],
        'after' => [
            'FilterSupplier' => ['except' => ['Dashboard/indexsupplier', 'Dashboard/Profil', 'Ganti_Akun', 'Ganti_Akun/*', 'Supplier', 'Supplier/*', 'laporan/bahanmentah', 'PengadaanBahan', 'PengadaanBahan/*']],
            'FilterGudang' => ['except' => ['Dashboard/indexGudang', 'Dashboard/Profil', 'AbsensiAdmin/adminGudang', 'Ganti_Akun', 'Ganti_Akun/*', 'BahanMasuk', 'BahanMasuk/*', 'BahanMentah', 'BahanMentah/*', 'BahanTerpakai', 'BahanTerpakai/*', 'StokBarangJadi', 'StokBarangJadi/*']],
            'FilterProduksi' => ['except' => ['Dashboard/indexProduksi', 'Dashboard/Profil', 'Ganti_Akun', 'Ganti_Akun/*', 'JadwalProduksi', 'JadwalProduksi/*', 'HasilProduksi', 'HasilProduksi/*', 'laporan/bahanmentah', 'laporan/barangjadi', 'KebutuhanProduksi', 'KebutuhanProduksi/*']],
            'FilterPengiriman' => ['except' => ['Dashboard', 'Dashboard/*', 'Ganti_Akun', 'Ganti_Akun/*', 'JadwalPengiriman', 'JadwalPengiriman/*', 'Armada', 'Armada/*']],
            'FilterPemasaran' => ['except' => ['Dashboard/indexPemasaran', 'Ganti_Akun', 'Ganti_Akun/*', 'SalesMarketing', 'SalesMarketing/*', 'Penjualan', 'Penjualan/*', 'Laporan/index', 'Laporan/barangjadi', 'Laporan/*']],
            'FilterKeuangan' => ['except' => ['Dashboard/indexKeuangan', 'Ganti_Akun', 'Ganti_Akun/*', 'AnggaranPengadaanBahan', 'AnggaranPengadaanBahan/*', 'AnggaranKebutuhanPerawatan', 'AnggaranKebutuhanPerawatan/*']],
        ],


    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        //     'Auth' => ['before' => [
        //     'dashboard',
        //     'dashboard/*',
        //     'supplier',
        //     'supplier/*',
        //     'bahanmasuk',
        //     'bahanmasuk/*',
        //     'bahanmentah',
        //     'bahanmentah/*',
        //     'bahanterpakai',
        //     'bahanterpakai/*',
        //     'asetmesin',
        //     'asetmesin/*',
        // ]]
    ];
}
