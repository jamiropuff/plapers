<?php

namespace App\Controllers;

class Cliente extends BaseController
{
    /**
     * Pantalla principal del cliente.
     */
    public function index()
    {
        $session = session();

        // Solo permitir el acceso a clientes autenticados.
        if (
            !$session->has('User_ID') ||
            (int) $session->get('Rol') !== 2
        ) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'Titulo' => 'Dashboard',
            'Descripcion' => ''
        ];

        $data_nav = [
            'menu_activo' => 'dashboard'
        ];

        echo view('templates/header');
        echo view('templates/nav-top', $data_nav);
        echo view('customer/dashboard', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    /**
     * Decide si el usuario debe iniciar sesión
     * o puede continuar con su compra.
     */
    public function continuar_compra()
    {
        $session = session();

        $esClienteAutenticado =
            $session->has('User_ID') &&
            (int) $session->get('Rol') === 2;

        if (!$esClienteAutenticado) {
            return redirect()->to(
                base_url('login?redirect=carrito/paso2')
            );
        }

        return redirect()->to(base_url('carrito/paso2'));
    }

    /**
     * Paso 2 del proceso de compra.
     */
    public function paso2()
    {
        $session = session();

        if (
            !$session->has('User_ID') ||
            (int) $session->get('Rol') !== 2
        ) {
            return redirect()->to(
                base_url('login?redirect=carrito/paso2')
            );
        }

        $data = [
            'Titulo' => 'Finalizar compra',
            'Descripcion' => ''
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('cart/paso2', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }
}

