<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class ProductosController extends BaseController
{

    protected $productoModel;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
    }

    /* ========================= LISTA ========================= */
    public function lista()
    {
        $session = session();
        $method = $this->request->getMethod(true);
        $activo = $this->request->getGet('activo') ?? "";

        if ($method === 'GET') {
            $code = REQUEST_SUCCESS;

            if ($activo !== "") {
                $productos = $this->productoModel->lista($activo);
            } else {
                $productos = $this->productoModel->lista();
            }
        } else {
            $code = METHOD_NOT_ALLOWED;
            $msg  = MSG_METHOD_NOT_ALLOWED;
        }

        // return $this->response->setJSON($productos);

        $data_breadcrumb = array(
            'title' => 'Productos',
            'icon' => '<i class="fa-solid fa-layer-group"></i>'
        );

        $data_main = array(
            'menu' => 'productos',
            'Titulo' => 'Productos',
            'Productos' => $productos,
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'productos',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/catalogos/productos', $data_main);
        echo view('admin/templates/footer', $data_footer);
    }

    /* ========================= AGREGA ========================= */

    public function agrega()
    {
        $method = $this->request->getMethod(true);

        if ($method !== 'POST') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $nomProducto    = $this->request->getPost('nom_producto');
        $idCategoria    = $this->request->getPost('id_categoria');
        $idSubcategoria = $this->request->getPost('id_subcategoria');
        $precio         = $this->request->getPost('precio');
        $descripcion    = $this->request->getPost('descripcion');
        $clave          = $this->request->getPost('clave');

        if (empty($nomProducto)) {
            return $this->response->setJSON([
                'Code' => INVALID_REQUEST,
                'Msg'  => 'Se requiere el nombre del producto'
            ]);
        }

        $productoModel = new ProductoModel();
        $response = $productoModel->agrega_producto(
            $nomProducto,
            $idCategoria,
            $idSubcategoria,
            $precio,
            $descripcion,
            $clave
        );

        $response['Code'] = REQUEST_SUCCESS;

        return $this->response->setJSON($response);
    }

    /* ========================= ACTIVA ========================= */

    public function activa()
    {
        return $this->cambiarStatus(1);
    }

    /* ========================= DESACTIVA ========================= */

    public function desactiva()
    {
        return $this->cambiarStatus(0);
    }

    /* ========================= HELPER ========================= */

    private function cambiarStatus(int $estatus)
    {
        $method = $this->request->getMethod(true);

        if ($method !== 'POST') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $idProducto = $this->request->getPost('id_producto');

        if (empty($idProducto)) {
            return $this->response->setJSON([
                'Code' => INVALID_REQUEST,
                'Msg'  => 'Se requiere el id del producto'
            ]);
        }

        $productoModel = new ProductoModel();
        $response = $productoModel->cambia_status($idProducto, $estatus);
        $response['Code'] = REQUEST_SUCCESS;

        return $this->response->setJSON($response);
    }
}
