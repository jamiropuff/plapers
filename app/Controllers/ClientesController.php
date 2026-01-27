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
}
