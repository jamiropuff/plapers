<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Productos extends BaseController
{
    /* ========================= LISTA ========================= */

    public function lista()
    {
        $method = $this->request->getMethod(true);

        if ($method !== 'GET') {
            return $this->response->setJSON([
                'Code' => METHOD_NOT_ALLOWED,
                'Msg'  => MSG_METHOD_NOT_ALLOWED
            ]);
        }

        $activo = $this->request->getGet('activo') ?? "";

        $productoModel = new ProductoModel();

        $response = [
            'Code' => REQUEST_SUCCESS,
            'Productos' => ($activo !== "")
                ? $productoModel->lista($activo)
                : $productoModel->lista()
        ];

        return $this->response->setJSON($response);
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
