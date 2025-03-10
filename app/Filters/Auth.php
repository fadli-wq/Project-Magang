<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Anda harus login terlebih dahulu!');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
      $session = session();
      $currentUrl = current_url();
      if ($session->get('isLoggedIn') && strpos($currentUrl, 'login') !== false) {
        return redirect()->to(base_url('dashboard'));
      }
    }
}
