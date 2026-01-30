<?php

namespace App\Controllers;

use App\Models\SubcategoriaModel;
use CodeIgniter\Controller;

class SubcategoriasController extends Controller
{
    protected $request;
    protected $response;
    protected $subcategoriaModel;

    public function __construct()
    {
        $this->request  = service('request');
        $this->response = service('response');
        $this->subcategoriaModel = new SubcategoriaModel();
    }

    /* =======================
       LISTA
       ======================= */
    public function lista()
    {
        $session = session();
        $method = $this->request->getMethod(true);
        $activo = $this->request->getGet('activo') ?? '';

        if ($method === 'GET') {

            $code = REQUEST_SUCCESS;

            if ($activo !== "") {
                $subcategorias = $this->subcategoriaModel->lista($activo);
            } else {
                $subcategorias = $this->subcategoriaModel->lista();
            }

        } else {
            $code = METHOD_NOT_ALLOWED;
            $msg  = MSG_METHOD_NOT_ALLOWED;
        }

        // return $this->response->setJSON($response);

        $data_breadcrumb = array(
            'title' => 'Subcategorias',
            'icon' => '<i class="fa-solid fa-table-cells"></i>'
        );

        $data_main = array(
            'menu' => 'subcategorias',
            'Titulo' => 'Subcategorias',
            'Subcategorias' => $subcategorias,
            'Code' => $code,
            'Msg'  => $msg ?? ""
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'subcategorias',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/catalogos/subcategorias', $data_main);
        echo view('admin/templates/footer', $data_footer);
        echo view('admin/templates/end', $data_footer);
    }

    public function listaJSON()
    {
        $method = $this->request->getMethod(true);
        $activo = $this->request->getGet('activo') ?? '';

        if ($method === 'GET') {

            $response["code"] = REQUEST_SUCCESS;

            if ($activo !== "") {
                $response = $this->subcategoriaModel->lista($activo);
            } else {
                $response = $this->subcategoriaModel->lista();
            }

        } else {
            $response["code"] = METHOD_NOT_ALLOWED;
            $response["msg"]  = MSG_METHOD_NOT_ALLOWED;
        }

        return $this->response->setJSON($response);

    }

    /* =======================
       BUSCA
       ======================= */
    public function busca($id = null)
    {
        $method = $this->request->getMethod(true);

        if ($method === 'GET') {

            if ($id === null) {
                $response = [
                    'Code' => INVALID_REQUEST,
                    'Msg'  => 'Se requiere el id de la categoría'
                ];
            } else {

                $model = new SubcategoriaModel();
                $subcategoria = $model->busca($id);

                if (empty($subcategoria)) {
                    $response = [
                        'Code' => NO_RESULTS
                    ];
                } else {
                    $response = [
                        'Code' => REQUEST_SUCCESS,
                        'Subcategoria' => $subcategoria
                    ];
                }
            }
        } else {
            $response = [
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ];
        }

        return $this->response->setJSON($response);
    }

    /* =======================
       AGREGA
       ======================= */
    public function agrega()
    {
        $method = $this->request->getMethod(true);

        if ($method === 'POST') {

            $idCategoria     = $this->request->getPost('id_categoria');
            $nomSubcategoria = $this->request->getPost('nom_subcategoria');

            if (empty($nomSubcategoria) || empty($idCategoria)) {

                $response = [
                    'Code' => INVALID_REQUEST,
                    'Msg'  => 'Se requiere el nombre de la subcategoría y el ID de la categoría'
                ];
            } else {

                $model = new SubcategoriaModel();
                $response = $model->agrega_subcategoria($idCategoria, $nomSubcategoria);
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response = [
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ];
        }

        return $this->response->setJSON($response);
    }

    /* =======================
       EDITA
       ======================= */
    public function edita()
    {
        $method = $this->request->getMethod(true);

        if ($method === 'POST') {

            $idCategoria     = $this->request->getPost('id_categoria');
            $idSubcategoria  = $this->request->getPost('id_subcategoria');
            $nomSubcategoria = $this->request->getPost('nom_subcategoria');

            if (
                empty($nomSubcategoria) ||
                empty($idCategoria) ||
                empty($idSubcategoria)
            ) {

                $response = [
                    'Code' => INVALID_REQUEST,
                    'Msg'  => 'Se requiere el nombre de la subcategoría y el id de la categoría'
                ];
            } else {

                $model = new SubcategoriaModel();
                $response = $model->edita_subcategoria(
                    $idSubcategoria,
                    $nomSubcategoria,
                    $idCategoria
                );
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response = [
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ];
        }

        return $this->response->setJSON($response);
    }

    /* =======================
       ACTIVA
       ======================= */
    public function activa()
    {
        $method = $this->request->getMethod(true);

        if ($method === 'POST') {

            $idSubcategoria = $this->request->getPost('id_subcategoria');

            if (empty($idSubcategoria)) {

                $response = [
                    'Code' => INVALID_REQUEST,
                    'Msg'  => 'Se requiere el id de la categoría'
                ];
            } else {

                $model = new SubcategoriaModel();
                $response = $model->cambia_status($idSubcategoria, 1);
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response = [
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ];
        }

        return $this->response->setJSON($response);
    }

    /* =======================
       DESACTIVA
       ======================= */
    public function desactiva()
    {
        $method = $this->request->getMethod(true);

        if ($method === 'POST') {

            $idSubcategoria = $this->request->getPost('id_subcategoria');

            if (empty($idSubcategoria)) {

                $response = [
                    'Code' => INVALID_REQUEST,
                    'Msg'  => 'Se requiere el id de la categoría'
                ];
            } else {

                $model = new SubcategoriaModel();
                $response = $model->cambia_status($idSubcategoria, 0);
                $response['Code'] = REQUEST_SUCCESS;
            }
        } else {
            $response = [
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ];
        }

        return $this->response->setJSON($response);
    }
}
