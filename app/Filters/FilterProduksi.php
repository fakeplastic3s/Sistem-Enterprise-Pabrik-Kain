<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterProduksi implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('user_name') == "") {
            // redirect ke halaman login
            return redirect()->to(base_url('/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('user_name') == 'Admin Produksi') {
            // redirect ke halaman login
            return redirect()->to(base_url('/Dashboard/indexProduksi'));
        }
    }
}
