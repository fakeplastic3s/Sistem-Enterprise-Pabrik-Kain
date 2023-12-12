<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StokBarangJadiModel;

class LandingPage extends BaseController
{
    public function index()
    {

        $data['title'] = 'PT Aji Wijayatex';
        echo view('/landing_page/index', $data);
    }

    public function katalog()
    {
        $stokbarang = new StokBarangJadiModel();
        $data['title'] = 'Katalog - PT Aji Wijayatex';
        $data['kain'] = $stokbarang->getStokBarangJadi();
        echo view('/landing_page/katalog', $data);
    }

    public function about()
    {

        $data['title'] = 'Tentang Kami - PT Aji Wijayatex';
        echo view('/landing_page/about', $data);
    }
}
