<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class ClientesController extends BaseController
{
    public array $acceso = ["1", "3"];

    public function ver_clientes()
    {
        $session = session();
        $data_main = [];

        if ($session->has('Rol') && in_array($session->get('Rol'), [1, 3])) {

            $Id_Rol = $session->get('Rol');

            if (empty($Id_Rol)) {
                $data_main["Msg"]  = "No se encontró el rol del usuario";
                $data_main["Code"] = INVALID_REQUEST;
            } else {
                $clienteModel = new ClienteModel();
                $cliente = $clienteModel->obtiene_datos_cliente($Id_Rol);
            }
        } else {
            $data_main["Code"] = REQUEST_FAILED;
            $data_main["Msg"]  = "No se encontró el Rol del usuario";
        }

        $data_breadcrumb = array(
            'title' => 'Clientes',
            'icon' => '<i class="fa-solid fa-file-invoice-dollar"></i>'
        );

        $data_main = array(
            'menu' => 'clientes',
            'Titulo' => 'Clientes',
            'Clientes' => $cliente,
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'clientes',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/clientes/clientes', $data_main);
        echo view('admin/templates/footer', $data_footer);
        echo view('admin/templates/end', $data_footer);
    }

    public function listaJSON()
    {
        $session = session();
        $response = [];

        if ($session->has('Rol') && in_array($session->get('Rol'), [1, 3])) {

            $Id_Rol = $session->get('Rol');

            if (empty($Id_Rol)) {
                $response["Msg"]  = "No se encontró el rol del usuario";
                $response["Code"] = INVALID_REQUEST;
            } else {
                $clienteModel = new ClienteModel();
                $response = $clienteModel->obtiene_datos_cliente($Id_Rol);
            }
        } else {
            $response["Code"] = REQUEST_FAILED;
            $response["Msg"]  = "No se encontró el Rol del usuario";
        }

        return $this->response->setJSON($response);
    }

    public function info()
    {

        $session = session();
        // $data_main = [];
        $data_main["Titulo"] = "Cliente Detalle";
        $method = $this->request->getMethod();

        if ($method === 'get') {

            $Id_User = $this->request->uri->getSegment(4);

            if (empty($Id_User)) {
                $data_main["Msg"]  = "No se encontró ese usuario";
                $data_main["Code"] = INVALID_REQUEST;
            } else {
                $clienteModel = new ClienteModel();
                $cliente_info = $clienteModel->obtiene_cliente_info($Id_User);
            }
        } else {
            $data_main["Code"] = METHOD_NOT_ALLOWED;
            $data_main["Msg"]  = MSG_METHOD_NOT_ALLOWED;
        }

        $data_breadcrumb = array(
            'title' => 'Clientes',
            'icon' => '<i class="fa-solid fa-file-invoice-dollar"></i>'
        );

        $data_main = array(
            'menu' => 'clientes',
            'Titulo' => 'Clientes',
            'Cliente_Info' => $cliente_info,
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'clientes',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/clientes/info', $data_main);
        echo view('admin/templates/footer', $data_footer);
        echo view('admin/templates/end', $data_footer);
    }

    public function cambiar_tipo_usuario()
    {
        $method = $this->request->getMethod();

        if ($method !== 'post') {
            return $this->response->setJSON([
                "Code" => METHOD_NOT_ALLOWED,
                "Msg"  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $Id_Usuario       = $this->request->getPost("id_usuario");
        $Id_Tipo_Usuario  = $this->request->getPost("id_tipo_usuario");
        $Id_User          = $this->request->getCookie("UserID");

        if (empty($Id_Usuario) || empty($Id_Tipo_Usuario)) {
            return $this->response->setJSON([
                "Code" => INVALID_REQUEST,
                "Msg"  => "Se requiere el ID del usuario y el ID del tipo de usuario"
            ]);
        }

        $clienteModel = new ClienteModel();
        $response = $clienteModel->cambia_tipo_usuario(
            $Id_Usuario,
            $Id_Tipo_Usuario,
            $Id_User
        );

        $response["Code"] = REQUEST_SUCCESS;

        return $this->response->setJSON($response);
    }

    /******************************************************************************/
    // Portal de Clientes (Frontend)
    /******************************************************************************/

    /**
     * Vista principal de Mi Cuenta / Perfil
     */
    public function mi_cuenta()
    {
        $session = session();
        $userId  = $session->get('User_ID');

        $db = \Config\Database::connect();

        $usuario = $db->table('t_usuarios')
            ->where('id_user', $userId)
            ->get()
            ->getFirstRow();

        $info = $db->table('t_info_usuarios')
            ->where('id_user', $userId)
            ->get()
            ->getFirstRow();

        $totalPedidos = $db->table('t_orden')
            ->where('id_user', $userId)
            ->countAllResults();

        $totalDirecciones = $db->table('cat_direcciones')
            ->where('id_user', $userId)
            ->countAllResults();

        $tieneFacturacion = $db->table('cat_datos_facturacion')
            ->where('id_user', $userId)
            ->countAllResults() > 0;

        $data = [
            'Titulo'      => 'mi_cuenta',
            'Descripcion' => 'Mi Perfil de Cliente',
            'usuario'     => $usuario,
            'info'        => $info,
            'stats'       => [
                'total_pedidos'     => $totalPedidos,
                'total_direcciones' => $totalDirecciones,
                'tiene_facturacion' => $tieneFacturacion
            ]
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('cliente/mi_cuenta', $data);
        echo view('templates/footer', $data);
        echo view('templates/close');
    }

    /**
     * Actualizar datos personales del cliente
     */
    public function actualizar_datos()
    {
        $method = $this->request->getMethod();
        if (strtoupper($method) !== 'POST') {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => METHOD_NOT_ALLOWED,
                'message' => 'Método no permitido'
            ]);
        }

        $session = session();
        $userId  = $session->get('User_ID');

        $nombres = trim((string)$this->request->getPost('nombres'));
        $paterno = trim((string)$this->request->getPost('paterno'));
        $materno = trim((string)$this->request->getPost('materno'));

        if (empty($nombres) || empty($paterno)) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'El nombre y apellido paterno son obligatorios.'
            ]);
        }

        $db = \Config\Database::connect();
        $existe = $db->table('t_info_usuarios')
            ->where('id_user', $userId)
            ->countAllResults() > 0;

        if ($existe) {
            $db->table('t_info_usuarios')
                ->where('id_user', $userId)
                ->update([
                    'nombres' => $nombres,
                    'paterno' => $paterno,
                    'materno' => $materno
                ]);
        } else {
            $db->table('t_info_usuarios')->insert([
                'id_user' => $userId,
                'nombres' => $nombres,
                'paterno' => $paterno,
                'materno' => $materno
            ]);
        }

        // Actualizar sesión
        $session->set([
            'Nombres' => $nombres,
            'Paterno' => $paterno
        ]);

        return $this->response->setJSON([
            'status'  => 1,
            'Code'    => REQUEST_SUCCESS,
            'message' => 'Datos personales actualizados correctamente.'
        ]);
    }

    /**
     * Cambio de contraseña del cliente
     */
    public function cambiar_password()
    {
        $method = $this->request->getMethod();
        if (strtoupper($method) !== 'POST') {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => METHOD_NOT_ALLOWED,
                'message' => 'Método no permitido'
            ]);
        }

        $session = session();
        $userId  = $session->get('User_ID');

        $passActual  = (string)$this->request->getPost('pass_actual');
        $passNueva   = (string)$this->request->getPost('pass_nueva');
        $passConfirm = (string)$this->request->getPost('pass_nueva_confirm');

        if (empty($passActual) || empty($passNueva) || empty($passConfirm)) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'Por favor completa todos los campos de contraseña.'
            ]);
        }

        if (strlen($passNueva) < 6) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'La nueva contraseña debe tener al menos 6 caracteres.'
            ]);
        }

        if ($passNueva !== $passConfirm) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'La nueva contraseña y su confirmación no coinciden.'
            ]);
        }

        $db = \Config\Database::connect();
        $usuario = $db->table('t_usuarios')
            ->where('id_user', $userId)
            ->get()
            ->getFirstRow();

        if (!$usuario || !password_verify($passActual, $usuario->password)) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'La contraseña actual ingresada es incorrecta.'
            ]);
        }

        $db->table('t_usuarios')
            ->where('id_user', $userId)
            ->update([
                'password'    => password_hash($passNueva, PASSWORD_BCRYPT),
                'id_user_upd' => $userId,
                'fecha_upd'   => date('Y-m-d H:i:s')
            ]);

        return $this->response->setJSON([
            'status'  => 1,
            'Code'    => REQUEST_SUCCESS,
            'message' => 'Tu contraseña ha sido actualizada con éxito.'
        ]);
    }

    /**
     * Historial de compras del cliente
     */
    public function mis_compras()
    {
        $session = session();
        $userId  = $session->get('User_ID');

        $db = \Config\Database::connect();

        $builder = $db->table('t_orden a');
        $builder->select('
            a.id_orden, a.fecha_pedido, a.total, a.subtotal, a.iva, a.envio,
            a.id_estatus_pedido, a.id_estatus_pago, a.id_tipo_pago,
            b.estatus_pedido, c.estatus_pago, d.tipo_pago
        ');
        $builder->join('cat_estatus_pedido b', 'a.id_estatus_pedido = b.id_estatus_pedido', 'left');
        $builder->join('cat_estatus_pago c', 'a.id_estatus_pago = c.id_estatus_pago', 'left');
        $builder->join('cat_tipo_pago d', 'a.id_tipo_pago = d.id_tipo_pago', 'left');
        $builder->where('a.id_user', $userId);
        $builder->orderBy('a.id_orden', 'DESC');

        $ordenes = $builder->get()->getResult();

        $data = [
            'Titulo'      => 'mis_compras',
            'Descripcion' => 'Historial de mis pedidos en Plapers',
            'ordenes'     => $ordenes
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('cliente/mis_compras', $data);
        echo view('templates/footer', $data);
        echo view('templates/close');
    }

    /**
     * Detalle JSON de una orden específica
     */
    public function detalle_compra($id_orden = null)
    {
        $session = session();
        $userId  = $session->get('User_ID');

        if (empty($id_orden)) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'Folio de orden no especificado.'
            ]);
        }

        $db = \Config\Database::connect();

        $builder = $db->table('t_orden a');
        $builder->select('
            a.id_orden, a.fecha_pedido, a.total, a.subtotal, a.iva, a.envio,
            b.estatus_pedido, c.estatus_pago, d.tipo_pago
        ');
        $builder->join('cat_estatus_pedido b', 'a.id_estatus_pedido = b.id_estatus_pedido', 'left');
        $builder->join('cat_estatus_pago c', 'a.id_estatus_pago = c.id_estatus_pago', 'left');
        $builder->join('cat_tipo_pago d', 'a.id_tipo_pago = d.id_tipo_pago', 'left');
        $builder->where('a.id_orden', $id_orden);
        $builder->where('a.id_user', $userId);

        $orden = $builder->get()->getFirstRow();

        if (!$orden) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => NO_RESULTS,
                'message' => 'No se encontró la orden solicitada o no pertenece a tu cuenta.'
            ]);
        }

        $productos = $db->table('t_orden_producto')
            ->where('id_orden', $id_orden)
            ->get()
            ->getResult();

        return $this->response->setJSON([
            'status'    => 1,
            'Code'      => REQUEST_SUCCESS,
            'orden'     => $orden,
            'productos' => $productos
        ]);
    }

    /**
     * Gestión de direcciones de envío del cliente
     */
    public function mis_direcciones()
    {
        $session = session();
        $userId  = $session->get('User_ID');

        $db = \Config\Database::connect();

        $builder = $db->table('cat_direcciones a');
        $builder->select('a.*, b.nombre_estado AS nom_estado');
        $builder->join('cat_estados b', 'a.estado = b.id_estado', 'left');
        $builder->where('a.id_user', $userId);
        $builder->orderBy('a.id_direccion', 'DESC');

        $direcciones = $builder->get()->getResult();

        $estados = $db->table('cat_estados')
            ->orderBy('estado', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'Titulo'      => 'mis_direcciones',
            'Descripcion' => 'Mis Direcciones de Envío',
            'direcciones' => $direcciones,
            'estados'     => $estados
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('cliente/mis_direcciones', $data);
        echo view('templates/footer', $data);
        echo view('templates/close');
    }

    /**
     * Guardar nueva dirección
     */
    public function guardar_direccion()
    {
        $method = $this->request->getMethod();
        if (strtoupper($method) !== 'POST') {
            return $this->response->setJSON(['status' => 0, 'Code' => METHOD_NOT_ALLOWED, 'message' => 'Método no permitido']);
        }

        $session = session();
        $userId  = $session->get('User_ID');

        $recibe   = trim((string)$this->request->getPost('recibe'));
        $telefono = trim((string)$this->request->getPost('telefono'));
        $calle    = trim((string)$this->request->getPost('calle'));
        $numero   = trim((string)$this->request->getPost('numero'));
        $interior = trim((string)$this->request->getPost('interior'));
        $colonia  = trim((string)$this->request->getPost('colonia'));
        $municipio = trim((string)$this->request->getPost('municipio'));
        $estado   = (int)$this->request->getPost('estado');
        $cp       = trim((string)$this->request->getPost('codigo_postal'));
        $ref      = trim((string)$this->request->getPost('referencia'));

        if (empty($recibe) || empty($telefono) || empty($calle) || empty($numero) || empty($colonia) || empty($municipio) || empty($estado) || empty($cp)) {
            return $this->response->setJSON(['status' => 0, 'Code' => INVALID_REQUEST, 'message' => 'Por favor completa todos los campos requeridos (*).']);
        }

        $db = \Config\Database::connect();
        $db->table('cat_direcciones')->insert([
            'recibe'            => $recibe,
            'telefono'          => $telefono,
            'calle'             => $calle,
            'numero'            => $numero,
            'interior'          => $interior ?: '0',
            'colonia'           => $colonia,
            'municipio'         => $municipio,
            'estado'            => $estado,
            'codigo_postal'     => $cp,
            'referencia'        => $ref ?: '0',
            'notas_adicionales' => '0',
            'pais'              => 1,
            'id_user'           => $userId
        ]);

        return $this->response->setJSON([
            'status'  => 1,
            'Code'    => REQUEST_SUCCESS,
            'message' => 'Dirección agregada correctamente.'
        ]);
    }

    /**
     * Obtener una dirección por ID (JSON)
     */
    public function obtener_direccion($id_direccion = null)
    {
        $session = session();
        $userId  = $session->get('User_ID');

        $db = \Config\Database::connect();
        $direccion = $db->table('cat_direcciones')
            ->where('id_direccion', $id_direccion)
            ->where('id_user', $userId)
            ->get()
            ->getFirstRow();

        if (!$direccion) {
            return $this->response->setJSON(['status' => 0, 'Code' => NO_RESULTS, 'message' => 'Dirección no encontrada']);
        }

        return $this->response->setJSON([
            'status'    => 1,
            'Code'      => REQUEST_SUCCESS,
            'direccion' => $direccion
        ]);
    }

    /**
     * Actualizar una dirección existente
     */
    public function actualizar_direccion()
    {
        $method = $this->request->getMethod();
        if (strtoupper($method) !== 'POST') {
            return $this->response->setJSON(['status' => 0, 'Code' => METHOD_NOT_ALLOWED, 'message' => 'Método no permitido']);
        }

        $session = session();
        $userId  = $session->get('User_ID');
        $id_direccion = (int)$this->request->getPost('id_direccion');

        $db = \Config\Database::connect();
        $existe = $db->table('cat_direcciones')
            ->where('id_direccion', $id_direccion)
            ->where('id_user', $userId)
            ->countAllResults() > 0;

        if (!$existe) {
            return $this->response->setJSON(['status' => 0, 'Code' => INVALID_REQUEST, 'message' => 'Dirección no encontrada o no pertenece a tu cuenta.']);
        }

        $db->table('cat_direcciones')
            ->where('id_direccion', $id_direccion)
            ->where('id_user', $userId)
            ->update([
                'recibe'        => trim((string)$this->request->getPost('recibe')),
                'telefono'      => trim((string)$this->request->getPost('telefono')),
                'calle'         => trim((string)$this->request->getPost('calle')),
                'numero'        => trim((string)$this->request->getPost('numero')),
                'interior'      => trim((string)$this->request->getPost('interior')) ?: '0',
                'colonia'       => trim((string)$this->request->getPost('colonia')),
                'municipio'     => trim((string)$this->request->getPost('municipio')),
                'estado'        => (int)$this->request->getPost('estado'),
                'codigo_postal' => trim((string)$this->request->getPost('codigo_postal')),
                'referencia'    => trim((string)$this->request->getPost('referencia')) ?: '0'
            ]);

        return $this->response->setJSON([
            'status'  => 1,
            'Code'    => REQUEST_SUCCESS,
            'message' => 'Dirección actualizada con éxito.'
        ]);
    }

    /**
     * Eliminar dirección
     */
    public function eliminar_direccion($id_direccion = null)
    {
        $session = session();
        $userId  = $session->get('User_ID');

        $db = \Config\Database::connect();
        $deleted = $db->table('cat_direcciones')
            ->where('id_direccion', $id_direccion)
            ->where('id_user', $userId)
            ->delete();

        if ($deleted) {
            return $this->response->setJSON(['status' => 1, 'Code' => REQUEST_SUCCESS, 'message' => 'Dirección eliminada.']);
        }

        return $this->response->setJSON(['status' => 0, 'Code' => REQUEST_FAILED, 'message' => 'No se pudo eliminar la dirección.']);
    }

    /**
     * Domicilio Fiscal / Facturación
     */
    public function domicilio_fiscal()
    {
        $session = session();
        $userId  = $session->get('User_ID');

        $db = \Config\Database::connect();

        $facturacion = $db->table('cat_datos_facturacion')
            ->where('id_user', $userId)
            ->get()
            ->getFirstRow();

        $usos_cfdi = $db->table('cat_uso_cfdi')
            ->orderBy('id_uso', 'ASC')
            ->get()
            ->getResultArray();

        $estados = $db->table('cat_estados')
            ->orderBy('nombre_estado', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'Titulo'      => 'domicilio_fiscal',
            'Descripcion' => 'Datos de Facturación CFDI',
            'facturacion' => $facturacion,
            'usos_cfdi'   => $usos_cfdi,
            'estados'     => $estados
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('cliente/domicilio_fiscal', $data);
        echo view('templates/footer', $data);
        echo view('templates/close');
    }

    /**
     * Guardar Domicilio Fiscal
     */
    public function guardar_domicilio_fiscal()
    {
        $method = $this->request->getMethod();
        if (strtoupper($method) !== 'POST') {
            return $this->response->setJSON(['status' => 0, 'Code' => METHOD_NOT_ALLOWED, 'message' => 'Método no permitido']);
        }

        $session = session();
        $userId  = $session->get('User_ID');

        $tipoPersona = (int)$this->request->getPost('tipo_persona');
        $rfc         = strtoupper(trim((string)$this->request->getPost('rfc')));
        $razonSocial = trim((string)$this->request->getPost('razon_social'));
        $nombres     = trim((string)$this->request->getPost('nombres'));
        $paterno     = trim((string)$this->request->getPost('paterno'));
        $materno     = trim((string)$this->request->getPost('materno'));
        $curp        = strtoupper(trim((string)$this->request->getPost('curp')));
        $uso         = trim((string)$this->request->getPost('uso'));
        $calle       = trim((string)$this->request->getPost('calle'));
        $numero      = trim((string)$this->request->getPost('numero'));
        $interior    = trim((string)$this->request->getPost('interior'));
        $colonia     = trim((string)$this->request->getPost('colonia'));
        $municipio   = trim((string)$this->request->getPost('municipio'));
        $estado      = (int)$this->request->getPost('estado');
        $cp          = trim((string)$this->request->getPost('codigo_postal'));

        if (empty($rfc)) {
            return $this->response->setJSON(['status' => 0, 'Code' => INVALID_REQUEST, 'message' => 'El RFC es obligatorio.']);
        }

        if ($tipoPersona === 2 && (strlen($rfc) < 12 || strlen($rfc) > 13)) {
            return $this->response->setJSON(['status' => 0, 'Code' => INVALID_REQUEST, 'message' => 'El RFC de Persona Moral debe tener 12 caracteres.']);
        }

        if ($tipoPersona === 1 && strlen($rfc) !== 13) {
            return $this->response->setJSON(['status' => 0, 'Code' => INVALID_REQUEST, 'message' => 'El RFC de Persona Física debe tener 13 caracteres.']);
        }

        if (empty($calle) || empty($numero) || empty($colonia) || empty($municipio) || empty($estado) || empty($cp) || empty($uso)) {
            return $this->response->setJSON(['status' => 0, 'Code' => INVALID_REQUEST, 'message' => 'Por favor completa todos los campos del domicilio fiscal.']);
        }

        $db = \Config\Database::connect();

        $archivoCSF = null;
        $file = $this->request->getFile('documento_situacion_fiscal');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($file->getClientMimeType() === 'application/pdf') {
                $nombreArchivo = 'csf_u' . $userId . '_' . date('YmdHis') . '.' . $file->getExtension();
                $targetDir = ROOTPATH . 'uploads/constancias/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                $file->move($targetDir, $nombreArchivo);
                $archivoCSF = $nombreArchivo;
            }
        }

        $registroExistente = $db->table('cat_datos_facturacion')
            ->where('id_user', $userId)
            ->get()
            ->getFirstRow();

        $datos = [
            'tipo_persona'  => $tipoPersona,
            'razon_social'  => $tipoPersona === 2 ? $razonSocial : trim("$nombres $paterno $materno"),
            'rfc'           => $rfc,
            'curp'          => $curp ?: '0',
            'calle'         => $calle,
            'numero'        => $numero,
            'interior'      => $interior ?: '0',
            'colonia'       => $colonia,
            'municipio'     => $municipio,
            'estado'        => $estado,
            'codigo_postal' => $cp,
            'pais'          => 1,
            'nombres'       => $nombres ?: '0',
            'paterno'       => $paterno ?: '0',
            'materno'       => $materno ?: '0',
            'uso'           => $uso,
            'id_user'       => $userId
        ];

        if ($archivoCSF) {
            $datos['documento_situacion_fiscal'] = $archivoCSF;
        }

        if ($registroExistente) {
            $db->table('cat_datos_facturacion')
                ->where('id_user', $userId)
                ->update($datos);
        } else {
            $db->table('cat_datos_facturacion')->insert($datos);
        }

        return $this->response->setJSON([
            'status'  => 1,
            'Code'    => REQUEST_SUCCESS,
            'message' => 'Datos fiscales guardados correctamente.'
        ]);
    }

    /**
     * Utilidad de desarrollo: Inyecta sesión de cliente sin pasar por login
     */
    public function dev_simular_sesion($id_user = 329)
    {
        $db = \Config\Database::connect();
        $usuario = $db->table('t_usuarios')
            ->where('id_user', $id_user)
            ->get()
            ->getFirstRow();

        if (!$usuario) {
            return "Usuario de prueba no encontrado en la base de datos.";
        }

        $info = $db->table('t_info_usuarios')
            ->where('id_user', $id_user)
            ->get()
            ->getFirstRow();

        $session = session();
        $session->regenerate(true);
        $session->set([
            'User_ID' => (int)$usuario->id_user,
            'User'    => $usuario->username,
            'Nombres' => $info->nombres ?? $usuario->username,
            'Paterno' => $info->paterno ?? '',
            'Rol'     => 2,
            'Nom_Rol' => 'Cliente'
        ]);

        return redirect()->to(base_url('mi-cuenta'));
    }
}
