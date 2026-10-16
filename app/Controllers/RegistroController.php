<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class RegistroController extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->has('User_ID') && (int)$session->get('Rol') === 2) {
            return redirect()->to(base_url('mi-cuenta'));
        }

        $data = [
            'Titulo'      => 'registro',
            'Descripcion' => 'Crea tu cuenta en Plapers'
        ];

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('users/registro', $data);
        echo view('templates/footer', $data);
        echo view('templates/close');
    }

    public function guardar()
    {
        $method = $this->request->getMethod();
        if (strtoupper($method) !== 'POST') {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => METHOD_NOT_ALLOWED,
                'message' => 'Método no permitido'
            ]);
        }

        $username        = trim((string)$this->request->getPost('username'));
        $correo          = trim((string)$this->request->getPost('correo_electronico'));
        $nombres         = trim((string)$this->request->getPost('nombres'));
        $paterno         = trim((string)$this->request->getPost('paterno'));
        $materno         = trim((string)$this->request->getPost('materno'));
        $password        = (string)$this->request->getPost('password');
        $passwordConfirm = (string)$this->request->getPost('password_confirm');
        $aceptaTerminos  = $this->request->getPost('acepta_terminos');

        if (empty($username) || empty($correo) || empty($nombres) || empty($paterno) || empty($password)) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'Por favor completa todos los campos requeridos.'
            ]);
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'El formato del correo electrónico es inválido.'
            ]);
        }

        if (strlen($password) < 6) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'La contraseña debe tener al menos 6 caracteres.'
            ]);
        }

        if ($password !== $passwordConfirm) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'Las contraseñas no coinciden.'
            ]);
        }

        if (!$aceptaTerminos) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'Debes aceptar los Términos y Condiciones y el Aviso de Privacidad.'
            ]);
        }

        $db = \Config\Database::connect();

        // Validar que no exista username ni correo
        $builder = $db->table('t_usuarios');
        $builder->groupStart()
            ->where('username', $username)
            ->orWhere('correo_electronico', $correo)
            ->groupEnd();

        if ($builder->countAllResults() > 0) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => INVALID_REQUEST,
                'message' => 'El nombre de usuario o el correo electrónico ya se encuentran registrados.'
            ]);
        }

        $db->transStart();

        $token = 'plap' . date('YmdHis') . '-u' . bin2hex(random_bytes(4));

        $db->table('t_usuarios')->insert([
            'username'           => $username,
            'id_rol'             => 2,
            'password'           => password_hash($password, PASSWORD_BCRYPT),
            'remember_token'     => $token,
            'active'             => 1,
            'correo_electronico' => $correo,
            'id_tipo_usuario'    => 1,
            'fecha_add'          => date('Y-m-d H:i:s')
        ]);

        $id_user = $db->insertID();

        $db->table('t_info_usuarios')->insert([
            'id_user' => $id_user,
            'nombres' => $nombres,
            'paterno' => $paterno,
            'materno' => $materno
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => 0,
                'Code'    => QUERY_FAILED,
                'message' => 'Ocurrió un error al registrar la cuenta. Por favor intenta de nuevo.'
            ]);
        }

        // Iniciar sesión automáticamente
        $session = session();
        $session->regenerate(true);
        $session->set([
            'User_ID' => $id_user,
            'User'    => $username,
            'Nombres' => $nombres,
            'Paterno' => $paterno,
            'Rol'     => 2,
            'Nom_Rol' => 'Cliente'
        ]);

        return $this->response->setJSON([
            'status'   => 1,
            'Code'     => REQUEST_SUCCESS,
            'message'  => '¡Registro exitoso! Bienvenido a Plapers.',
            'redirect' => base_url('mi-cuenta')
        ]);
    }
}
