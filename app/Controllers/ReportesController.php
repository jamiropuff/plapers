<?php

namespace App\Controllers;

use App\Models\ReporteModel;
use App\Models\CategoriaModel;
use App\Models\SubcategoriaModel;
use App\Models\ProductoModel;
use App\Models\CatTipoPagoModel;
use App\Models\CatEstatusPagoModel;
use App\Models\CatTipoEnvioModel;
use App\Models\CatEstatusPedidoModel;

class ReportesController extends BaseController
{

    public $acceso = [1, 3, 5];

    public function ver_reporte()
    {
        $db = \Config\Database::connect();
        $request = service('request');
        $session = session();

        if ($session->has('Rol') && in_array($session->get('Rol'), $this->acceso)) {

            $Id_Rol = $session->get('Rol');

            if (empty($Id_Rol)) {

                $reporte['Msg']  = 'No se encontró el rol del usuario';
                $reporte['Code'] = INVALID_REQUEST;
            } else {
                /* =======================
                   MÉTODO HTTP
                   ======================= */
                $Method = $request->getMethod(true);

                if ($Method === 'POST') {

                    $Id_Categoria       = trim($request->getPost('id_categoria'));
                    $Id_Subcategoria    = trim($request->getPost('id_subcategoria'));
                    $Id_Producto        = trim($request->getPost('id_producto'));
                    $Id_Tipo_Pago       = trim($request->getPost('id_tipo_pago'));
                    $Id_Estatus_Pago    = trim($request->getPost('id_estatus_pago'));
                    $Id_Tipo_Envio      = trim($request->getPost('id_tipo_envio'));
                    $Id_Estatus_Pedido  = trim($request->getPost('id_estatus_pedido'));
                    $Fecha_Inicio       = trim($request->getPost('fecha_inicio'));
                    $Fecha_Fin          = trim($request->getPost('fecha_fin'));
                } else {

                    $Id_Categoria = 0;
                    $Id_Subcategoria = 0;
                    $Id_Producto = 0;
                    $Id_Tipo_Pago = 0;
                    $Id_Estatus_Pago = 0;
                    $Id_Tipo_Envio = 0;
                    $Id_Estatus_Pedido = 0;
                    $Fecha_Inicio = 0;
                    $Fecha_Fin = 0;
                }


                /* =======================
                   MODELOS (CI4)
                   ======================= */
                $categoriaModel       = new CategoriaModel();
                $subcategoriaModel    = new SubcategoriaModel();
                $productoModel        = new ProductoModel();

                $categorias = $categoriaModel->lista();
                $subcategorias = $subcategoriaModel->lista();
                $productos = $productoModel->lista();

                $tipoPagoModel = new CatTipoPagoModel();
                $estatusPagoModel = new CatEstatusPagoModel();
                $tipoEnvioModel = new CatTipoEnvioModel();
                $estatusPedidoModel = new CatEstatusPedidoModel();
                $reporteModel = new ReporteModel();

                $tipoPago = $tipoPagoModel->lista();
                $estatusPago = $estatusPagoModel->lista();
                $tipoEnvio = $tipoEnvioModel->lista();
                $estatusPedido = $estatusPedidoModel->lista();

                $reporte = $reporteModel->obtiene_reporte($Id_Rol, $Id_Categoria, $Id_Subcategoria, $Id_Producto, $Id_Tipo_Pago, $Id_Tipo_Envio, $Id_Estatus_Pago, $Id_Estatus_Pedido, $Fecha_Inicio, $Fecha_Fin);

                //var_dump($reporte);
            }
        } else {
            $reporte["Code"] = REQUEST_FAILED;
            $reporte["Msg"] = "No se encotro el Rol del usuario";
        }


        $data_breadcrumb = array(
            'title' => 'Reporte de Ventas',
            'icon' => '<i class="fa-solid fa-file-invoice-dollar"></i>'
        );

        $data_main = array(
            'menu' => 'reporte_ventas',
            'reporte' => $reporte,
            'Categorias' => $categorias,
            'Subcategorias' => $subcategorias,
            'Productos' => $productos,
            'TipoPago' => $tipoPago,
            'EstatusPago' => $estatusPago,
            'TipoEnvio' => $tipoEnvio,
            'EstatusPedido' => $estatusPedido
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'reporte_ventas',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/reportes/reportes', $data_main);
        echo view('admin/templates/footer', $data_footer);
    }

    public function reporteJSON()
    {
        $db = \Config\Database::connect();
        $request = service('request');
        $session = session();

        if ($session->has('Rol') && in_array($session->get('Rol'), $this->acceso)) {

            $Id_Rol = $session->get('Rol');

            if (empty($Id_Rol)) {

                $reporte['Msg']  = 'No se encontró el rol del usuario';
                $reporte['Code'] = INVALID_REQUEST;
            } else {
                /* =======================
                   MÉTODO HTTP
                   ======================= */
                $Method = $request->getMethod(true);

                if ($Method === 'POST') {

                    $Id_Categoria       = trim($request->getPost('id_categoria'));
                    $Id_Subcategoria    = trim($request->getPost('id_subcategoria'));
                    $Id_Producto        = trim($request->getPost('id_producto'));
                    $Id_Tipo_Pago       = trim($request->getPost('id_tipo_pago'));
                    $Id_Estatus_Pago    = trim($request->getPost('id_estatus_pago'));
                    $Id_Tipo_Envio      = trim($request->getPost('id_tipo_envio'));
                    $Id_Estatus_Pedido  = trim($request->getPost('id_estatus_pedido'));
                    $Fecha_Inicio       = trim($request->getPost('fecha_inicio'));
                    $Fecha_Fin          = trim($request->getPost('fecha_fin'));
                } else {

                    $Id_Categoria = 0;
                    $Id_Subcategoria = 0;
                    $Id_Producto = 0;
                    $Id_Tipo_Pago = 0;
                    $Id_Estatus_Pago = 0;
                    $Id_Tipo_Envio = 0;
                    $Id_Estatus_Pedido = 0;
                    $Fecha_Inicio = 0;
                    $Fecha_Fin = 0;
                }


                /* =======================
                   MODELOS (CI4)
                   ======================= */
                $categoriaModel       = new CategoriaModel();
                $subcategoriaModel    = new SubcategoriaModel();
                $productoModel        = new ProductoModel();

                $categorias = $categoriaModel->lista();
                $subcategorias = $subcategoriaModel->lista();
                $productos = $productoModel->lista();

                $tipoPagoModel = new CatTipoPagoModel();
                $estatusPagoModel = new CatEstatusPagoModel();
                $tipoEnvioModel = new CatTipoEnvioModel();
                $estatusPedidoModel = new CatEstatusPedidoModel();
                $reporteModel = new ReporteModel();

                $tipoPago = $tipoPagoModel->lista();
                $estatusPago = $estatusPagoModel->lista();
                $tipoEnvio = $tipoEnvioModel->lista();
                $estatusPedido = $estatusPedidoModel->lista();

                $reporte = $reporteModel->obtiene_reporte($Id_Rol, $Id_Categoria, $Id_Subcategoria, $Id_Producto, $Id_Tipo_Pago, $Id_Tipo_Envio, $Id_Estatus_Pago, $Id_Estatus_Pedido, $Fecha_Inicio, $Fecha_Fin);

                $response = array(
                    'menu' => 'reporte_ventas',
                    'reporte' => $reporte,
                    'Categorias' => $categorias,
                    'Subcategorias' => $subcategorias,
                    'Productos' => $productos,
                    'TipoPago' => $tipoPago,
                    'EstatusPago' => $estatusPago,
                    'TipoEnvio' => $tipoEnvio,
                    'EstatusPedido' => $estatusPedido
                );
            }
        } else {
            $reporte["Code"] = REQUEST_FAILED;
            $reporte["Msg"] = "No se encotro el Rol del usuario";
        }




        return $this->response->setJSON($response);
    }
}
