<?php

namespace App\Controllers;

use App\Models\OrdenModel;

class OrdenesController extends BaseController
{

    public function ordenes_activas($Id_Rol = 0, $Id_Tipo_Pago = 0, $Id_Tipo_Envio = 0, $Id_Estatus_Pago = 0, $Id_Estatus_Pedido = 0)
    {
        $db = \Config\Database::connect();
        $session = session();

        echo "<script>console.log('Nombres: " . $session->Nombres . "');</script>";

        // Builder principal
        $builder = $db->table('t_orden AS a');
        $builder->select('
            a.id_orden, a.id_user, e.nombres, e.paterno, e.materno,
            a.id_tipo_pago, a.id_tipo_envio, a.id_estatus_pago, a.id_estatus_pedido,
            a.subtotal, a.iva, a.envio, a.total, a.id_direccion, a.id_facturacion,
            a.fecha_pedido, a.fecha_produccion, a.fecha_entrega, a.fecha_enviado, a.fecha_completo,
            a.activo, a.comprobante, 
            b.tipo_pago, c.estatus_pago, d.estatus_pedido
        ');

        // JOINs
        $builder->join('cat_tipo_pago AS b', 'a.id_tipo_pago = b.id_tipo_pago');
        $builder->join('cat_estatus_pago AS c', 'a.id_estatus_pago = c.id_estatus_pago');
        $builder->join('cat_estatus_pedido AS d', 'a.id_estatus_pedido = d.id_estatus_pedido');
        $builder->join('t_info_usuarios AS e', 'a.id_user = e.id_user');

        // Filtros base
        $builder->where('a.id_estatus_pago !=', 3); // omitir cancelados

        if ($Id_Tipo_Pago > 0) {
            $builder->where("a.id_tipo_pago", $Id_Tipo_Pago);
        }
        if ($Id_Tipo_Envio > 0) {
            $builder->where("a.id_tipo_envio", $Id_Tipo_Envio);
        }
        if ($Id_Estatus_Pago > 0) {
            $builder->where("a.id_estatus_pago", $Id_Estatus_Pago);
        }
        if ($Id_Estatus_Pedido > 0) {
            $builder->where("a.id_estatus_pedido", $Id_Estatus_Pedido);
        }
        // Producción
        if ($Id_Rol == 5) {
            $builder->where("(a.id_estatus_pedido = 2 OR a.id_estatus_pedido = 6)");
        } else {
            $builder->where("(a.id_estatus_pedido != 8 AND a.id_estatus_pedido != 9)");
        }
        $builder->orderBy("a.id_orden", "DESC");

        $ordenes = $builder->get()->getResult(); // Ejecutar la consulta y obtener los resultados


        $data_breadcrumb = array(
            'title' => 'Ordenes Activas',
            'icon' => '<i class="fa-solid fa-file-invoice"></i>'
        );

        $data_main = array(
            'menu' => 'ordenes_activas',
            'ordenes' => $ordenes,
        );

        $data_session = array(
            'session' => $session
        );

        $data_footer = array(
            'menu' => 'ordenes_activas',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/ordenes/activas',$data_main);
        echo view('admin/templates/footer',$data_footer);
    }

    public function ordenes_finalizadas($Id_Rol = 0)
    {

        $db = \Config\Database::connect();
        $session = session();

        // Builder principal
        $builder = $db->table('plap_t_orden AS a');
        $builder->select('
            a.id_orden, a.id_user, e.nombres, e.paterno, e.materno, a.id_tipo_pago, 
            a.id_tipo_envio, a.id_estatus_pago, a.id_estatus_pedido, a.subtotal, 
            a.iva, a.envio, a.total, a.id_direccion, a.id_facturacion, a.fecha_pedido, 
            a.fecha_produccion, a.fecha_enviado, a.fecha_completo, a.activo, 
            b.tipo_pago, c.estatus_pago, d.estatus_pedido
        ');

        // JOINs
        $builder->join('cat_tipo_pago AS b', 'a.id_tipo_pago = b.id_tipo_pago');
        $builder->join('cat_estatus_pago AS c', 'a.id_estatus_pago = c.id_estatus_pago');
        $builder->join('cat_estatus_pedido AS d', 'a.id_estatus_pedido = d.id_estatus_pedido');
        $builder->join('t_info_usuarios AS e', 'a.id_user = e.id_user');

        // Filtros base
        if ($Id_Rol == 5) {
            $builder->where("(a.id_estatus_pedido = 3 OR a.id_estatus_pedido = 7 OR a.id_estatus_pedido = 8 OR a.id_estatus_pedido = 9)");
        } else {
            $builder->where("(a.id_estatus_pedido = 8 OR a.id_estatus_pedido = 9)");
        }
        $builder->orderBy("a.id_orden", "DESC");

        $ordenes = $builder->get()->getResult(); // Ejecutar la consulta y obtener los resultados


        $data_breadcrumb = array(
            'title' => 'Ordenes Finalizadas',
            'icon' => '<i class="fa-solid fa-file-import"></i>'
        );

        $data_main = array(
            'menu' => 'ordenes_finalizadas',
            'ordenes' => $ordenes
        );

        $data_session = array(
            'session' => $session
        );

        $data_footer = array(
            'menu' => 'ordenes_finalizadas',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/ordenes/finalizadas', $data_main);
        echo view('admin/templates/footer');
    }

    public function ordenes_canceladas($Id_Rol = 0)
    {

        $db = \Config\Database::connect();
        $session = session();

        // Builder principal
        $builder = $db->table('plap_t_orden AS a');
        $builder->select('
            a.id_orden, a.id_user, e.nombres, e.paterno, e.materno, a.id_tipo_pago, 
            a.id_tipo_envio, a.id_estatus_pago, a.id_estatus_pedido, a.subtotal, 
            a.iva, a.envio, a.total, a.id_direccion, a.id_facturacion, a.fecha_pedido, 
            a.fecha_produccion, a.fecha_enviado, a.fecha_completo, a.activo, 
            b.tipo_pago, c.estatus_pago, d.estatus_pedido
        ');

        // JOINs
        $builder->join('cat_tipo_pago AS b', 'a.id_tipo_pago = b.id_tipo_pago');
        $builder->join('cat_estatus_pago AS c', 'a.id_estatus_pago = c.id_estatus_pago');
        $builder->join('cat_estatus_pedido AS d', 'a.id_estatus_pedido = d.id_estatus_pedido');
        $builder->join('t_info_usuarios AS e', 'a.id_user = e.id_user');
        $builder->where("a.id_estatus_pago = 3");
        $builder->orderBy("a.id_orden", "DESC");

        $ordenes = $builder->get()->getResult(); // Ejecutar la consulta y obtener los resultados


        $data_breadcrumb = array(
            'title' => 'Ordenes Canceladas',
            'icon' => '<i class="fa-solid fa-file-excel"></i>'
        );

        $data_main = array(
            'menu' => 'ordenes_canceladas',
            'ordenes' => $ordenes
        );

        $data_session = array(
            'session' => $session
        );

        $data_footer = array(
            'menu' => 'ordenes_canceladas',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/ordenes/canceladas', $data_main);
        echo view('admin/templates/footer');
    }

    public function search()
    {
        //echo "searching...";

        // $fecha_inicio = $this->request->getPost('fecha_inicio');
        // $fecha_fin = $this->request->getPost('fecha_fin');

        // $prospectoModel = new ProspectoModel();


        // $prospectos = $prospectoModel->select('id, nombres, apellidos, email, telefono, plantel, interes, medio_entero, mensaje, fecha_upd')
        // ->where('fecha_upd >=', $fecha_inicio)
        // ->where('fecha_upd <=', $fecha_fin)
        // ->findAll();


        // if ( !$prospectos ) {
        //     //return redirect()->back()->with('mensaje', 'Usuario y/o contraseña incorrectos.');
        //     $response = array(
        //         'status' => 0,
        //         'message' => 'No se encontraron registros en ese periodo'
        //     );
        // }else{

        //     $response = array(
        //         'status' => 1,
        //         'message' => 'Success',
        //         'prospectos' => $prospectos
        //     );
        // }

        // return json_encode($response);
    }
}
