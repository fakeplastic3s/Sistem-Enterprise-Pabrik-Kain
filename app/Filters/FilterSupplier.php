<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterSupplier implements FilterInterface
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
        if (session()->get('user_name') == 'Admin Supplier') {
            // redirect ke halaman login
            return redirect()->to(base_url('/Dashboard/indexsupplier'));
        }
    }
}
