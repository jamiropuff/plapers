<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

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

        $userId = (int) $session->get('User_ID');
        $db = \Config\Database::connect();
        $direcciones = $db->table('cat_direcciones')
            ->where('id_user', $userId)
            ->orderBy('id_direccion', 'DESC')
            ->get()->getResult();
        $facturaciones = $db->table('cat_datos_facturacion')
            ->where('id_user', $userId)
            ->orderBy('id_facturacion', 'DESC')
            ->get()->getResult();

        $data = [
            'Titulo' => 'Datos Adicionales',
            'Descripcion' => '',
            'direcciones' => $direcciones,
            'facturaciones' => $facturaciones,
            'direccionSeleccionada' => $session->get('Checkout_Id_Direccion'),
            'facturacionSeleccionada' => $session->get('Checkout_Id_Facturacion')
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('store/step2', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    /** Guarda por separado la dirección de entrega y la fiscal elegidas. */
    public function seleccionar_domicilios()
    {
        $session = session();
        if (!$session->has('User_ID') || (int) $session->get('Rol') !== 2) {
            return redirect()->to(base_url('login?redirect=carrito/paso2'));
        }

        $direccionId = $this->request->getPost('id_direccion');
        $facturacionId = $this->request->getPost('id_facturacion');
        $direccionId = ($direccionId === '' || $direccionId === null) ? 0 : $direccionId;
        $facturacionId = ($facturacionId === '' || $facturacionId === null) ? 0 : $facturacionId;

        $usuarioModel = new UsuarioModel();
        if (!$usuarioModel->valida_domicilios_usuario((int) $session->get('User_ID'), $direccionId, $facturacionId)) {
            return redirect()->to(base_url('carrito/paso2'))
                ->with('checkout_address_error', 'Una de las direcciones seleccionadas no pertenece a tu cuenta.');
        }

        $session->set([
            'Checkout_Id_Direccion' => (int) $direccionId,
            'Checkout_Id_Facturacion' => (int) $facturacionId,
        ]);

        return redirect()->to(base_url('carrito/paso2'))
            ->with('checkout_address_success', 'Guardamos tus direcciones para esta compra.');
    }
}

