<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthRoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        // $session = session();

        // if(!$session){
        //     //return redirect('panel');
        //     return redirect()->to(ADMIN_HOME.'panel');
        // }

        // if($session->role_id != 1){
        //     //return redirect('panel');
        //     return redirect()->to(ADMIN_HOME.'panel');
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}