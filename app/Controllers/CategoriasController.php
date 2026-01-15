<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class CategoriasController extends Controller
{
    protected $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    public function lista()
    {
        $session = session();
        $method = $this->request->getMethod(true);
        $activo = $this->request->getGet('activo') ?? "";

        if ($method === 'GET') {
            $code = REQUEST_SUCCESS;

            if ($activo !== "") {
                $categorias = $this->categoriaModel->lista($activo);
            } else {
                $categorias = $this->categoriaModel->lista();
            }
        } else {
            $code = METHOD_NOT_ALLOWED;
            $msg  = MSG_METHOD_NOT_ALLOWED;
        }

        // return $this->response->setJSON($response);

        $data_breadcrumb = array(
            'title' => 'Categorias',
            'icon' => '<i class="fa-solid fa-list"></i>'
        );

        $data_main = array(
            'menu' => 'categorias',
            'Titulo' => 'Categorias',
            'Categorias' => $categorias,
            'Code' => $code,
            'Msg'  => $msg ?? ""
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'categorias',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/catalogos/categorias', $data_main);
        echo view('admin/templates/footer', $data_footer);
    }

    public function listaJSON()
    {
        $method = $this->request->getMethod(true);
        $activo = $this->request->getGet('activo') ?? "";

        if ($method === 'GET') {
            $response["code"] = REQUEST_SUCCESS;

            if ($activo !== "") {
                $response = $this->categoriaModel->lista($activo);
            } else {
                $response = $this->categoriaModel->lista();
            }
        } else {
            $response["code"] = METHOD_NOT_ALLOWED;
            $response["msg"]  = MSG_METHOD_NOT_ALLOWED;
        }

        return $this->response->setJSON($response);
    }

    public function busca($idCategoria = null)
    {
        $method = $this->request->getMethod(true);

        if ($method === 'GET') {
            if ($idCategoria === null) {
                $response['Msg']  = 'Se requiere el id de la categoría';
                $response['Code'] = INVALID_REQUEST;
            } else {
                $categoria = $this->categoriaModel->busca($idCategoria);

                if (empty($categoria)) {
                    $response['Code'] = NO_RESULTS;
                } else {
                    $response['Code']      = REQUEST_SUCCESS;
                    $response['Categoria'] = $categoria;
                }
            }
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg']  = MSG_METHOD_NOT_ALLOWED;
        }

        return $this->response->setJSON($response);
    }

    public function edita()
    {
        $method = $this->request->getMethod(true);

        $nomCategoria = $this->request->getPost('nom_categoria');
        $idCategoria  = $this->request->getPost('id_categoria');

        if ($method === 'POST') {
            if ($nomCategoria === "" || empty($idCategoria)) {
                $response['Msg']  = 'Se requiere el nombre de la categoría y el id de la categoría';
                $response['Code'] = INVALID_REQUEST;
            } else {
                $response = $this->categoriaModel->edita_categoria($idCategoria, $nomCategoria);
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg']  = MSG_METHOD_NOT_ALLOWED;
        }

        return $this->response->setJSON($response);
    }

    public function agrega()
    {
        $method = $this->request->getMethod(true);
        $nomCategoria = $this->request->getPost('nom_categoria');

        if ($method === 'POST') {
            if ($nomCategoria === "") {
                $response['Msg']  = 'Se requiere el nombre de la categoría';
                $response['Code'] = INVALID_REQUEST;
            } else {
                $response = $this->categoriaModel->agrega_categoria($nomCategoria);
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg']  = MSG_METHOD_NOT_ALLOWED;
        }

        return $this->response->setJSON($response);
    }

    public function activa()
    {
        $method = $this->request->getMethod(true);
        $idCategoria = $this->request->getPost('id_categoria');

        if ($method === 'POST') {
            if ($idCategoria === "") {
                $response['Msg']  = 'Se requiere el id de la categoría';
                $response['Code'] = INVALID_REQUEST;
            } else {
                $response = $this->categoriaModel->cambia_status($idCategoria, 1);
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg']  = MSG_METHOD_NOT_ALLOWED;
        }

        return $this->response->setJSON($response);
    }

    public function desactiva()
    {
        $method = $this->request->getMethod(true);
        $idCategoria = $this->request->getPost('id_categoria');

        if ($method === 'POST') {
            if ($idCategoria === "") {
                $response['Msg']  = 'Se requiere el id de la categoría';
                $response['Code'] = INVALID_REQUEST;
            } else {
                $response = $this->categoriaModel->cambia_status($idCategoria, 0);
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg']  = MSG_METHOD_NOT_ALLOWED;
        }

        return $this->response->setJSON($response);
    }
}
