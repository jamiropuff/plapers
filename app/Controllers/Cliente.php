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
        $usuarioModel = new UsuarioModel();

        if (!$session->has('User_ID') || (int) $session->get('Rol') !== 2) {
            return redirect()->to(base_url('login?redirect=carrito/paso2'));
        }

        $userId = (int) $session->get('User_ID');

        $idTipoEnvio = (int) $this->request->getPost('id_tipo_envio');
        $idTipoPago = (int) $this->request->getPost('id_tipo_pago');
        $requiereFactura = (int) $this->request->getPost('requiere_factura_hidden');

        $direccionId = (int) $this->request->getPost('id_direccion');
        $facturacionId = (int) $this->request->getPost('id_facturacion');

        // Detectar si se capturó un domicilio nuevo.
        $nuevaDireccion = $this->request->getPost('nueva_direccion') === '1';

        // ==========================================
        // 1. REGISTRAR NUEVA DIRECCIÓN DE ENTREGA
        // ==========================================

        if ($idTipoEnvio === 1 && $nuevaDireccion) {

            $token = (string) $session->get('Token');

            if ($token === '') {
                return redirect()->to(base_url('carrito/paso2'))
                    ->with('checkout_address_error', 'Tu sesión no contiene un token válido.');
            }

            $resultado = $usuarioModel->registra_direccion(
                $token,
                $this->request->getPost('entrega_recibe'),
                $this->request->getPost('entrega_calle'),
                $this->request->getPost('entrega_numero'),
                $this->request->getPost('entrega_interior'),
                $this->request->getPost('entrega_colonia'),
                $this->request->getPost('entrega_municipio'),
                $this->request->getPost('entrega_estado'),
                $this->request->getPost('entrega_codigo_postal'),
                $this->request->getPost('entrega_referencia'),
                $this->request->getPost('entrega_notas_adicionales'),
                $this->request->getPost('entrega_pais'),
                $this->request->getPost('entrega_telefono')
            );

            // Verificar que se haya guardado correctamente.
            if (
                ($resultado['Code'] ?? null) !== REQUEST_SUCCESS ||
                empty($resultado['Id'])
            ) {
                return redirect()->to(base_url('carrito/paso2'))
                    ->with('checkout_address_error', 'No fue posible registrar el domicilio.');
            }

            // Recuperar el ID generado por la base de datos.
            $direccionId = (int) $resultado['Id'];
        }


        // ==========================================
        // REGISTRAR NUEVA DIRECCIÓN FISCAL
        // ==========================================

        $nuevaFacturacion = $this->request->getPost('nueva_facturacion') === '1';

        // Si no requiere factura, no debe conservar ningún domicilio fiscal.
        if ($requiereFactura !== 1) {
            $facturacionId = 0;
        }

        // Si está capturando uno nuevo, ignorar cualquier ID anterior.
        if ($requiereFactura === 1 && $nuevaFacturacion) {
            $facturacionId = 0;
        }

        if ($requiereFactura === 1 && $nuevaFacturacion) {

            $token = (string) $session->get('Token');

            if ($token === '') {
                return redirect()->to(base_url('carrito/paso2'))
                    ->with('checkout_address_error', 'Tu sesión no contiene un token válido.');
            }

            // Obtener constancia fiscal, si se adjuntó.
            $documentoFiscal = null;
            $archivo = $this->request->getFile('fiscal_constancia');

            if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {

                $ruta = WRITEPATH . 'uploads/documentos_fiscales/';

                if (!is_dir($ruta)) {
                    mkdir($ruta, 0755, true);
                }

                $nombreArchivo = $archivo->getRandomName();
                $archivo->move($ruta, $nombreArchivo);

                $documentoFiscal = $nombreArchivo;
            }

            $resultadoFiscal = $usuarioModel->registra_facturacion(
                $token,
                $this->request->getPost('fiscal_razon_social'),
                $this->request->getPost('fiscal_rfc'),
                $this->request->getPost('fiscal_curp'),
                $this->request->getPost('fiscal_nombres'),
                $this->request->getPost('fiscal_paterno'),
                $this->request->getPost('fiscal_materno'),
                $this->request->getPost('fiscal_calle'),
                $this->request->getPost('fiscal_numero'),
                $this->request->getPost('fiscal_interior'),
                $this->request->getPost('fiscal_colonia'),
                $this->request->getPost('fiscal_municipio'),
                $this->request->getPost('fiscal_estado'),
                $this->request->getPost('fiscal_codigo_postal'),
                $this->request->getPost('fiscal_pais'),
                $this->request->getPost('fiscal_uso_cfdi'),
                $this->request->getPost('fiscal_tipo_persona'),
                $documentoFiscal
            );

            if (
                ($resultadoFiscal['Code'] ?? null) !== REQUEST_SUCCESS ||
                empty($resultadoFiscal['Id'])
            ) {
                return redirect()->to(base_url('carrito/paso2'))
                    ->with('checkout_address_error', 'No fue posible registrar los datos fiscales.');
            }

            // Recuperar el ID generado.
            $facturacionId = (int) $resultadoFiscal['Id'];
        }


        // ==========================================
        // 2. RECOGER EN OFICINA
        // ==========================================

        if ($idTipoEnvio === 2) {
            $direccionId = 0;
        }

        if ($idTipoEnvio === 1 && $direccionId <= 0) {
            return redirect()->to(base_url('carrito/paso2'))
                ->with('checkout_address_error', 'Debes seleccionar o registrar un domicilio de entrega.');
        }

        if ($requiereFactura === 1 && $facturacionId <= 0) {
            return redirect()->to(base_url('carrito/paso2'))
                ->with('checkout_address_error', 'Debes seleccionar o registrar un domicilio fiscal.');
        }

        if (!in_array($idTipoEnvio, [1, 2], true)) {
            return redirect()->to(base_url('carrito/paso2'))
                ->with('checkout_address_error', 'Selecciona un tipo de envío válido.');
        }

        if (!in_array($requiereFactura, [0, 1], true)) {
            return redirect()->to(base_url('carrito/paso2'))
                ->with('checkout_address_error', 'La opción de facturación no es válida.');
        }


        // ==========================================
        // 3. VALIDAR PROPIEDAD DE LOS DOMICILIOS
        // ==========================================

        if (!$usuarioModel->valida_domicilios_usuario(
            $userId,
            $direccionId,
            $facturacionId
        )) {
            return redirect()->to(base_url('carrito/paso2'))
                ->with('checkout_address_error', 'Una de las direcciones seleccionadas no pertenece a tu cuenta.');
        }

        // ==========================================
        // 4. GUARDAR DATOS EN SESIÓN
        // ==========================================

        $session->set([
            'Checkout_Id_Direccion' => $direccionId,
            'Checkout_Id_Facturacion' => $facturacionId,
            'Checkout_Id_Tipo_Envio' => $idTipoEnvio,
            'Checkout_Id_Tipo_Pago' => $idTipoPago,
            'Checkout_Requiere_Factura' => $requiereFactura
        ]);

        // ==========================================
        // 5. CONTINUAR AL PASO 3
        // ==========================================

        return redirect()->to(base_url('carrito/paso3'));
    }


    /**
     * Paso 3: Verificar orden.
     */
    public function paso3()
    {
        $session = session();

        if (
            !$session->has('User_ID') ||
            (int) $session->get('Rol') !== 2
        ) {
            return redirect()->to(base_url('login?redirect=carrito/paso2'));
        }

        $userId = (int) $session->get('User_ID');
        $db = \Config\Database::connect();

        $idDireccion = (int) $session->get('Checkout_Id_Direccion');
        $idFacturacion = (int) $session->get('Checkout_Id_Facturacion');

        $direccion = null;
        $facturacion = null;

        if ($idDireccion > 0) {
            $direccion = $db->table('cat_direcciones')
                ->where('id_direccion', $idDireccion)
                ->where('id_user', $userId)
                ->get()->getRow();
        }

        if ($idFacturacion > 0) {
            $facturacion = $db->table('cat_datos_facturacion')
                ->where('id_facturacion', $idFacturacion)
                ->where('id_user', $userId)
                ->get()->getRow();
        }

        $data = [
            'Titulo' => 'Verificar orden',
            'Descripcion' => '',
            'direccionEnvio' => $direccion,
            'datosFacturacion' => $facturacion,
            'idTipoEnvio' => $session->get('Checkout_Id_Tipo_Envio'),
            'idTipoPago' => $session->get('Checkout_Id_Tipo_Pago'),
            'requiereFactura' => $session->get('Checkout_Requiere_Factura'),
            'cargarScriptsCarrito' => true,
            'cargarScriptCheckoutPaso3' => true
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('store/step3', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }
}
