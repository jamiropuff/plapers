<?php

namespace App\Controllers;

use App\Models\CatalogosModel;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class CarritoController extends BaseController
{

    protected $ctalogosModel;
    protected $productoModel;
    protected $categoriaModel;

    public function __construct()
    {
        $this->ctalogosModel = new CatalogosModel();
        $this->productoModel = new ProductoModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function carrito()
    {

        $data = array(
            'Titulo' => "Carrito",
            'Descripcion' => "Carrito de compras"
        );

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('store/cart', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    public function catalogos()
    {
        $method = $this->request->getMethod(true);
        if ($method === 'GET') {
            $response = $this->ctalogosModel->catalogos();
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg'] = MSG_METHOD_NOT_ALLOWED;
        }
        return $this->response->setJSON($response);
    }

}
