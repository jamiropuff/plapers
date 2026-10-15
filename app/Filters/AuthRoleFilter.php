<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthRoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Validar que exista una sesión autenticada.
        if (
            !$session->has('User_ID') ||
            !$session->has('Rol')
        ) {
            return redirect()->to(
                empty($arguments) || !in_array('2', $arguments, true)
                    ? ADMIN_HOME . 'panel'
                    : base_url('login')
            );
        }

        // Roles permitidos definidos en Routes.php.
        $rolesPermitidos = array_map(
            'intval',
            $arguments ?? []
        );

        // Validar permisos.
        if (!in_array((int) $session->Rol, $rolesPermitidos, true)) {

            if ((int) $session->Rol === 2) {
                return redirect()->to(base_url('mi-cuenta'));
            }

            return redirect()->to(ADMIN_HOME . 'panel');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Sin acciones posteriores.
    }
}
