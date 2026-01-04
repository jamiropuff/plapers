<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class Categorias extends Controller
{
    protected $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    public function lista()
    {
        $method = $this->request->getMethod(true);
        $activo = $this->request->getGet('activo') ?? "";

        if ($method === 'GET') {
            $response['Code'] = REQUEST_SUCCESS;

            if ($activo !== "") {
                $response['Categorias'] = $this->categoriaModel->lista($activo);
            } else {
                $response['Categorias'] = $this->categoriaModel->lista();
            }
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg']  = MSG_METHOD_NOT_ALLOWED;
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
