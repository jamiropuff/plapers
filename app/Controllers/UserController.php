<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UserController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsuarioModel();
    }

    public function login()
    {

        $db = \Config\Database::connect();
        $usuarioModel = new UsuarioModel();

        $user = $this->request->getPost('user');
        $pass = $this->request->getPost('pass');

        $active = 1;

        $builder = $db->table('t_usuarios AS tu');
        $builder->select('
            tu.id_user, username, tu.id_rol, nom_rol, password, 
            nombres, paterno, materno, correo_electronico, id_tipo_usuario
        ');

        $builder->join('cat_roles AS cr', 'tu.id_rol = cr.id_rol');
        $builder->join('t_info_usuarios AS tiu', 'tiu.id_user = tu.id_user');

        $builder->where('username', $user); // verificamos si existe el usuario
        $builder->where('active', $active); // verificamos si existe el usuario
        $usuario = $builder->get()->getFirstRow(); // Ejecutar la consulta y obtener el primer registro

        if (!$usuario) {
            $response = array(
                'status' => 0,
                'message' => 'Usuario y/o contraseña incorrectos'
            );
        }

        if ($usuarioModel->verifyPass($pass, $usuario->password)) {

            $token = "plap" . date("YmdHis") . "-u" . $usuario->id_user  . "-" . bin2hex(random_bytes(8));

            $arr_session = array(
                'User_ID' => $usuario->id_user,
                'Token' => $token,
                'User' => $usuario->username,
                'Nombres' => $usuario->nombres,
                'Paterno' => $usuario->paterno,
                'Rol' => $usuario->id_rol,
                'Nom_Rol' => $usuario->nom_rol,
            );

            $user_action = $usuarioModel->update(
                $usuario->id_user,
                [
                    'remember_token' => $token
                ]
            );

            $session = session();
            $session->set($arr_session);

            setcookie("Username", $usuario->username, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("Nombres", $usuario->nombres, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("Paterno", $usuario->paterno, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("Email", $usuario->correo_electronico, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("Materno", $usuario->materno, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("UserID", $usuario->id_user, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("Tipo_Usuario", $usuario->id_tipo_usuario, time() + (86400 * 30), "/"); // 86400 = 1 day

            $response = array(
                'status' => 1,
                'message' => 'Success',
                'Code' => 200
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Usuario o contraseña incorrectos',
                'Code' => 400

            );
        }

        return json_encode($response);
    }

    public function logout()
    {

        $session = session();
        $session->destroy();

        //return redirect()->to(route_to('panel'));
        return redirect()->to(ADMIN_HOME . 'panel');
    }

    public function randomPass($longitud)
    {
        $cadena = "[^a-zA-Z0-9!@#\$%\^&\*\?_~\/]";
        return substr(preg_replace($cadena, "", md5(rand())) .  preg_replace($cadena, "", md5(rand())) .  preg_replace($cadena, "", md5(rand())),  0, $longitud);
    }

    public function password()
    {

        $data_breadcrumb = array(
            'title' => 'Cambiar Contraseña',
            'icon' => '<i class="fas fa-key"></i>'
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_breadcrumb);
        echo view('admin/templates/nav-aside', $data_breadcrumb);
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/users/password');
        echo view('admin/templates/footer', $data_breadcrumb);
    }

    public function upd_pass()
    {
        $usuarioModel = new UsuarioModel();

        $clave = $this->request->getPost('clave');
        $user_id = intval(1);


        $usuario_action = $usuarioModel->update(
            $user_id,
            [
                'pass' => $usuarioModel->passHash($clave)
            ]

        );

        if (!$usuario_action) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar modificar la información'
            );
        } else {

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Contraseña actualizada con éxito.'
            );
        }

        return json_encode($response);
    }

    public function crear_usuario()
    {
        $usuarioModel = new UsuarioModel();

        /*
        $usuarioModel->insert(
            [
                'usuario' => 'admin',
                'email' => 'admin@impo.org.mx',
                'pass' => $usuarioModel->passHash('Master123#')
            ]

        );
        */
        /*
        $usuarioModel->insert(
            [
                'usuario' => 'regular',
                'email' => 'regular@impo.org.mx',
                'pass' => $usuarioModel->passHash('123')
            ]

        );
        */
    }

    public function test_pass()
    {
        $usuarioModel = new UsuarioModel();

        //$verify = $usuarioModel->verifyPass('Master123#','$2y$10$RdNUU/v5QOsp.u5W2R.eieJ8RFHnVhDlYlqZzOc.LmLr1jNaWqOf.');
        //var_dump($verify);

    }

    public function ver_usuarios()
    {
        $session = session();
        $data_main = [];

        if ($session->has('Rol') && in_array($session->get('Rol'), [1])) {

            $Id_Rol = $session->get('Rol');

            if (empty($Id_Rol)) {
                $data_main["Msg"]  = "No se encontró el rol del usuario";
                $data_main["Code"] = INVALID_REQUEST;
            } else {
                $usuarioModel = new UsuarioModel();
                $usuarios = $usuarioModel->lista_usuarios();
                // var_dump($usuarios);
            }
        } else {
            $data_main["Code"] = REQUEST_FAILED;
            $data_main["Msg"]  = "No se encontró el Rol del usuario";
        }

        $data_breadcrumb = array(
            'title' => 'Usuarios',
            'icon' => '<i class="fa-solid fa-file-invoice-dollar"></i>'
        );

        $data_main = array(
            'menu' => 'usuarios',
            'Titulo' => 'Usuarios',
            'Usuarios' => $usuarios,
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'usuarios',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/users/usuarios', $data_main);
        echo view('admin/templates/footer', $data_footer);
    }

    public function usuariosJSON()
    {
        $session = session();
        $data_main = [];

        if ($session->has('Rol') && in_array($session->get('Rol'), [1])) {

            $Id_Rol = $session->get('Rol');
            $tipo = $this->request->getJSON()->tipo ?? null;

            if (empty($Id_Rol)) {
                $response["Msg"]  = "No se encontró el rol del usuario";
                $response["Code"] = INVALID_REQUEST;
            } else {

                if (empty($tipo)) {
                    return $this->response->setJSON([
                        "Code" => INVALID_REQUEST,
                        "Msg"  => "No se recibió el tipo de consulta"
                    ]);
                }
                $usuarioModel = new UsuarioModel();
                $response = $usuarioModel->lista_usuarios($tipo);
                // var_dump($response);
            }
        } else {
            $response["Code"] = REQUEST_FAILED;
            $response["Msg"]  = "No se encontró el Rol del usuario";
        }

        return $this->response->setJSON($response);
    }

    /* =========================
     * DATOS FACTURACIÓN
     * ========================= */
    public function datos_facturacion()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $token = $this->request->getPost('Token');

        if (empty($token)) {
            return $this->response->setJSON([
                'Code' => INVALID_REQUEST,
                'Msg'  => 'No se encontró token'
            ]);
        }

        return $this->response->setJSON(
            $this->userModel->obtiene_datos_facturacion($token)
        );
    }

    /* =========================
     * DATOS DIRECCIÓN
     * ========================= */
    public function datos_direccion()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $token = $this->request->getPost('Token');

        if (empty($token)) {
            return $this->response->setJSON([
                'Code' => INVALID_REQUEST,
                'Msg'  => 'No se encontró token'
            ]);
        }

        return $this->response->setJSON(
            $this->userModel->obtiene_datos_direcciones($token)
        );
    }

    /* =========================
     * REGISTRA DIRECCIÓN
     * ========================= */
    public function registra_direccion()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $data = $this->request->getPost();

        if (empty($data['Token'])) {
            return $this->response->setJSON([
                'Code' => INVALID_REQUEST,
                'Msg'  => 'No se encontró token'
            ]);
        }

        $required = ['Recibe', 'Calle', 'Numero', 'Colonia', 'Municipio', 'Codigo_Postal', 'Pais', 'Telefono'];

        foreach ($required as $field) {
            if (empty($data[$field])) {
                return $this->response->setJSON([
                    'Code' => INVALID_REQUEST,
                    'Msg'  => 'Se requieren todos los campos'
                ]);
            }
        }

        return $this->response->setJSON(
            $this->userModel->registra_direccion(
                $data['Token'],
                $data['Recibe'],
                $data['Calle'],
                $data['Numero'],
                $data['Interior'] ?? '',
                $data['Colonia'],
                $data['Municipio'],
                $data['Estado'] ?? '',
                $data['Codigo_Postal'],
                $data['Referencia'] ?? '',
                $data['Notas'] ?? '',
                $data['Pais'],
                $data['Telefono']
            )
        );
    }

    /* =========================
     * REGISTRA FACTURACIÓN
     * ========================= */
    public function registra_facturacion()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $data = $this->request->getPost();
        $file = $this->request->getFile('Documento_situacion_fiscal');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON([
                'Code' => INVALID_REQUEST,
                'Msg'  => 'Documento fiscal requerido'
            ]);
        }

        $fileName = 'constancia_' . $data['RFC'] . '_' . date('YmdHis') . '.' . $file->getExtension();
        $file->move(WRITEPATH . 'uploads/documentos', $fileName);

        return $this->response->setJSON(
            $this->userModel->registra_facturacion(
                $data['Token'],
                $data['Razon_Social'] ?? '',
                $data['RFC'],
                $data['CURP'] ?? '',
                $data['Nombres'] ?? '',
                $data['Paterno'] ?? '',
                $data['Materno'] ?? '',
                $data['Calle'],
                $data['Numero'],
                $data['Interior'] ?? '',
                $data['Colonia'],
                $data['Municipio'],
                $data['Estado'] ?? '',
                $data['Codigo_Postal'],
                $data['Pais'],
                $data['Uso'],
                $data['Tipo_Persona'],
                $fileName
            )
        );
    }

    /* =========================
     * GUARDA ORDEN
     * ========================= */
    public function guarda_orden()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $data = $this->request->getPost();
        $productos = json_decode($data['Productos'] ?? '[]');

        $orden = $this->userModel->registra_orden(
            $data['Token'],
            $data['Id_Tipo_Pago'],
            $data['Id_Estatus_Pago'],
            $data['Id_Tipo_Envio'],
            $data['Id_Estatus_Pedido'],
            $data['Subtotal'],
            $data['Iva'],
            $data['Envio'],
            $data['Total'],
            $data['Id_Direccion'],
            $data['Id_Facturacion'],
            $data['Notas_Adicionales'] ?? '',
            $data['Id_uso']
        );

        if (($orden['Code'] ?? 0) !== REQUEST_SUCCESS) {
            return $this->response->setJSON($orden);
        }

        foreach ($productos as $product) {
            $this->userModel->registra_producto(
                $data['Token'],
                $orden['Id'],
                $product->id_producto,
                $product->nom_categoria,
                $product->nom_producto,
                $product->personalizacion->posicion ?? '',
                $product->personalizacion->linea1->texto ?? '',
                $product->personalizacion->linea1->fuente ?? '',
                $product->personalizacion->linea1->caracteres ?? '',
                $product->personalizacion->linea2->texto ?? '',
                $product->personalizacion->linea2->fuente ?? '',
                $product->personalizacion->linea2->caracteres ?? '',
                $product->personalizacion->linea3->texto ?? '',
                $product->personalizacion->linea3->fuente ?? '',
                $product->personalizacion->linea3->caracteres ?? '',
                $product->personalizacion->color ?? '',
                $product->personalizacion->acabado ?? '',
                $product->foto,
                $product->cantidad,
                $product->precio_unitario,
                $product->precio
            );
        }

        return $this->response->setJSON($orden);
    }
}
