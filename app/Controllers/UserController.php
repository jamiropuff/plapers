<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UserController extends BaseController
{
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
}
