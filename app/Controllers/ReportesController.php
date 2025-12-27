<?php

namespace App\Controllers;

use App\Models\OrdenModel;
use App\Models\CatTipoPagoModel;
use App\Models\CatEstatusPagoModel;
use App\Models\CatTipoEnvioModel;
use App\Models\CatEstatusPedidoModel;

class ReportesController extends BaseController
{

    public $acceso = ["1","3","5"];

    public function ver_reporte()
    {
        $db = \Config\Database::connect();
        $session = session();

        if (isset($session->Rol) && ($session->Rol == 1 || $session->Rol == 3 || $session->Rol == 5)) {

            $Id_Rol = $session->Rol;


            if ($Id_Rol == "") {
                $reporte["Msg"] = "No se encontrró el rol del usuario";
                $reporte["Code"] = INVALID_REQUEST;
            } else {

                $Method = $this->request->getMethod(true);

                if ($Method === "POST") {
                    $Id_Categoria = trim($this->request->getPost("id_categoria"));
                    $Id_Subcategoria = trim($this->request->getPost("id_subcategoria"));
                    $Id_Producto = trim($this->request->getPost("id_producto"));
                    $Id_Tipo_Pago = trim($this->request->getPost("id_tipo_pago"));
                    $Id_Estatus_Pago = trim($this->request->getPost("id_estatus_pago"));
                    $Id_Tipo_Envio = trim($this->request->getPost("id_tipo_envio"));
                    $Id_Estatus_Pedido = trim($this->request->getPost("id_estatus_pedido"));
                    $Fecha_Inicio = trim($this->request->getPost("fecha_inicio"));
                    $Fecha_Fin = trim($this->request->getPost("fecha_fin"));
                }else{
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




                $tipoPagoModel = new CatTipoPagoModel();
                $estatusPagoModel = new CatEstatusPagoModel();
                $tipoEnvioModel = new CatTipoEnvioModel();
                $estatusPedidoModel = new CatEstatusPedidoModel();

                $tipoPago = $tipoPagoModel->lista();
                $estatusPago = $estatusPagoModel->lista();
                $tipoEnvio = $tipoEnvioModel->lista();
                $estatusPedido = $estatusPedidoModel->lista();

                $reporte["Reporte"] = $this->reporte->obtiene_reporte($Id_Rol, $Id_Categoria, $Id_Subcategoria, $Id_Producto, $Id_Tipo_Pago, $Id_Tipo_Envio, $Id_Estatus_Pago, $Id_Estatus_Pedido, $Fecha_Inicio, $Fecha_Fin);

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
            'tipoPago' => $tipoPago,
            'estatusPago' => $estatusPago,
            'tipoEnvio' => $tipoEnvio,
            'estatusPedido' => $estatusPedido
        );

        // echo "<pre>", var_dump($data_main), "</pre>";

        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'ordenes_activas',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/ordenes/activas', $data_main);
        echo view('admin/templates/footer', $data_footer);
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
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
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
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/ordenes/canceladas', $data_main);
        echo view('admin/templates/footer');
    }


    /***********************************************************/

	public function lista_envio($id_tipo_envio = 0)
	{

        $db = \Config\Database::connect();

		$builder = $db->table('plap_cat_estatus_pedido');
		$builder->select('estatus_pedido, id_estatus_pedido, id_tipo_envio, activo');

		if($id_tipo_envio > 0){
			$builder->where("id_tipo_envio", $id_tipo_envio);
		}else{
			$builder->where("id_tipo_envio", "1");
		}

		$builder->orderBy("activo", "desc");
		$builder->orderBy("id_estatus_pedido", "asc");
		$query = $builder->get();

		$estatus_pedido = [];
		foreach ($query->getResult() as $row)
		{
			$estatus_pedido[] = (object)["id_estatus_pedido" => $row->id_estatus_pedido, "id_tipo_envio" => $row->id_tipo_envio,"estatus_pedido" => $row->estatus_pedido, "activo" => $row->activo];
		}
		return $estatus_pedido;
	} 

    // Obtiene los datos de facturación del cliente
    public function obtiene_cliente_direccion_facturacion($Id_Direccion_Facturacion)
    {

        $db = \Config\Database::connect();

        $builder = $db->table('cat_datos_facturacion');
        $builder->select('id_facturacion, razon_social, rfc, curp, calle, numero, interior, colonia, municipio, estado, codigo_postal, pais, nombres, paterno, materno, uso, tipo_persona, id_user, documento_situacion_fiscal ');
        $builder->where("id_facturacion", $Id_Direccion_Facturacion);
        $builder->orderBy("id_facturacion", "ASC");

        $query = $builder->get(); // Ejecutar la consulta y obtener los resultados
        $direccion_facturacion = [];
        $Response["Code"] = REQUEST_SUCCESS;
        $Msg = "Direccion Facturacion";
        foreach ($query->getResult() as $row) {
            // Estado
            $Id_Estado = $row->estado;
            $arr_estado = $this->estado($Id_Estado);
            $estado = $arr_estado[0]['Nombre_Estado'];
            // Pais
            $Id_Pais = $row->pais;
            $arr_pais = $this->pais($Id_Pais);
            $pais = $arr_pais[0]['Nombre_Pais'];
            // USO CFDI
            $Id_Uso = $row->uso;
            $arr_uso = $this->uso_cfdi($Id_Uso);
            $uso_cfdi = $arr_uso[0]['nombre_uso'];

            $direccion_facturacion[] = (object)[
                "Id_Facturacion" => $row->id_facturacion,
                "Razon_Social" => $row->razon_social,
                "Rfc" => $row->rfc,
                "Curp" => $row->curp,
                "Calle" => $row->calle,
                "Numero" => $row->numero,
                "Interior" => $row->interior,
                "Colonia" => $row->colonia,
                "Municipio" => $row->municipio,
                "Id_Estado" => $row->estado,
                "Estado" => $estado,
                "Codigo_Postal" => $row->codigo_postal,
                "Id_Pais" => $row->pais,
                "Pais" => $pais,
                "Nombres" => $row->nombres,
                "Paterno" => $row->paterno,
                "Materno" => $row->materno,
                "Uso" => $uso_cfdi,
                "Tipo_Persona" => $row->tipo_persona,
                "Id_user" => $row->id_user,
                "Documento_Situacion_Fiscal" => $row->documento_situacion_fiscal
            ];
        }
        $Response = $direccion_facturacion;

        return $Response;
    }

    // Obtiene los estados
    public function estado($Id_Estado = 0)
    {

        $db = \Config\Database::connect();

        $builder = $db->table('cat_estados');
        $builder->select('id_estado, nombre_estado');
        $builder->where('id_estado', $Id_Estado);
        $builder->orderBy("nombre_estado", "ASC");
        $query = $builder->get();
        $estado = [];
        foreach ($query->getResult() as $row) {
            $estado[] = (object)[
                "Id_Estado" => $row->id_estado,
                "Nombre_Estado" => $row->nombre_estado
            ];
        }
        return $estado;
    }

    // Obtiene los países
    public function pais($Id_Pais = 0)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('cat_paises');
        $builder->select('id_pais, nombre_pais');
        $builder->where('id_pais', $Id_Pais);
        $builder->orderBy("nombre_pais", "ASC");
        $query = $builder->get();
        $pais = [];
        foreach ($query->getResult() as $row) {
            $pais[] = (object)[
                "Id_Pais" => $row->id_pais,
                "Nombre_Pais" => $row->nombre_pais
            ];
        }
        return $pais;
    }

    // Obtiene el uso del CFDI
    public function uso_cfdi($Id_Uso = 0)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('cat_uso_cfdi');
        $builder->select('id_uso, nombre_uso');
        $builder->where('id_uso', $Id_Uso);
        $builder->orderBy("id_uso", "ASC");
        $query = $builder->get();
        $uso = [];
        foreach ($query->getResult() as $row) {
            $uso[] = (object)[
                "id_uso" => $row->id_uso,
                "nombre_uso" => $row->nombre_uso
            ];
        }
        return $uso;
    }

    // Obtiene el listado del estatus de pago
    public function listado_pago()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('cat_estatus_pago');
        $builder->select('id_estatus_pago, estatus_pago');
        $builder->orderBy("id_estatus_pago", "ASC");
        $query = $builder->get();
        $estatus_pago = [];
        foreach ($query->getResult() as $row) {
            $estatus_pago[] = (object)[
                "id_estatus_pago" => $row->id_estatus_pago,
                "estatus_pago" => $row->estatus_pago
            ];
        }
        return $estatus_pago;
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
