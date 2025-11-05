<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UserController extends BaseController
{
    public function login() {

        $usuarioModel = new UsuarioModel();

        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password');
        //$identifier = $this->randomPass(10);
        //$web_identifier = hash('sha256', $identifier);

        $is_deleted = 0;

        $usuario = $usuarioModel->select('id, role_id, usuario, email, pass')
        ->where('email', $email)
        ->where('is_deleted', $is_deleted)
        ->first();

        if ( !$usuario ) {
            //return redirect()->back()->with('mensaje', 'Usuario y/o contraseña incorrectos.');
            $response = array(
                'status' => 0,
                'message' => 'Usuario o contraseña incorrectos'
            );
        }

        if ( $usuarioModel->verifyPass($pass, $usuario->pass) ) {

            $arr_session = array(
                'user_id' => $usuario->id,
                'role_id' => $usuario->role_id,
                'email' => $usuario->email,
                'usuario' => $usuario->usuario
            );

            $session = session();
            $session->set($arr_session);

            $response = array(
                'status' => 1,
                'message' => 'Success'
            );

        }else{
            $response = array(
                'status' => 0,
                'message' => 'Usuario o contraseña incorrectos'    
            );
    
        }

        return json_encode($response);
    }

    public function logout() {

        $session = session();
        $session->destroy();

        //return redirect()->to(route_to('panel'));
        return redirect()->to(ADMIN_HOME.'panel');
    }

    public function randomPass($longitud) {
        $cadena="[^a-zA-Z0-9!@#\$%\^&\*\?_~\/]";  
        return substr(preg_replace($cadena, "", md5(rand())) .  preg_replace($cadena, "", md5(rand())) .  preg_replace($cadena, "", md5(rand())),  0, $longitud);
    }

    public function password() {
        
        $data_breadcrumb = array(
            'title' => 'Cambiar Contraseña',
            'icon' => '<i class="fas fa-key"></i>'
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_breadcrumb);
        echo view('admin/templates/nav-aside',$data_breadcrumb);
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/users/password');
        echo view('admin/templates/footer',$data_breadcrumb);
    }

    public function upd_pass() {
        $usuarioModel = new UsuarioModel();

        $clave = $this->request->getPost('clave');
        $user_id = intval(1);

        
        $usuario_action = $usuarioModel->update($user_id,
            [
                'pass' => $usuarioModel->passHash($clave)
            ]

        );

        if ( !$usuario_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar modificar la información'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Contraseña actualizada con éxito.'
            );
        }
        
        return json_encode($response);
        
    }

    public function crear_usuario() {
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

    public function test_pass() {
        $usuarioModel = new UsuarioModel();

        //$verify = $usuarioModel->verifyPass('Master123#','$2y$10$RdNUU/v5QOsp.u5W2R.eieJ8RFHnVhDlYlqZzOc.LmLr1jNaWqOf.');
        //var_dump($verify);
        
    }
}