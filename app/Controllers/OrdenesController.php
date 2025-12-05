<?php

namespace App\Controllers;

use App\Models\OrdenModel;
use App\Models\CatTipoPagoModel;
use App\Models\CatEstatusPagoModel;
use App\Models\CatTipoEnvioModel;
use App\Models\CatEstatusPedidoModel;

class OrdenesController extends BaseController
{

    public function ordenes_activas($Id_Rol = 0, $Id_Tipo_Pago = 0, $Id_Tipo_Envio = 0, $Id_Estatus_Pago = 0, $Id_Estatus_Pedido = 0)
    {
        $db = \Config\Database::connect();
        $session = session();

        $tipoPagoModel = new CatTipoPagoModel();
        $estatusPagoModel = new CatEstatusPagoModel();
        $tipoEnvioModel = new CatTipoEnvioModel();
        $estatusPedidoModel = new CatEstatusPedidoModel();

        $tipoPago = $tipoPagoModel->lista();
        $estatusPago = $estatusPagoModel->lista();
        $tipoEnvio = $tipoEnvioModel->lista();
        $estatusPedido = $estatusPedidoModel->lista();

        // Builder principal
        $builder = $db->table('t_orden AS a');
        $builder->select('
            a.id_orden, a.id_user, e.nombres, e.paterno, e.materno,
            a.id_tipo_pago, a.id_tipo_envio, a.id_estatus_pago, a.id_estatus_pedido,
            a.subtotal, a.iva, a.envio, a.total, a.id_direccion, a.id_facturacion,
            a.fecha_pedido, a.fecha_produccion, a.fecha_entrega, a.fecha_enviado, a.fecha_completo,
            a.activo, a.comprobante, a.constancia, a.fecha_constancia, 
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

        $query = $builder->get(); // Ejecutar la consulta        
        $ordenes = [];

        $array_tipo_envio = [];

        foreach ($query->getResult() as $row) {
            // echo "<pre>", var_dump($row), "</pre>";

            // Tipo de Envío
            $id_tipo_envio = $row->id_tipo_envio;
            if ($id_tipo_envio > 0) {
                $cat_tipo_envio = $this->lista_envio($id_tipo_envio);
            } else {
                $cat_tipo_envio = $this->lista_envio("1");
            }

            // Facturación
            $id_facturacion = $row->id_facturacion;

            if ($id_facturacion > 0) {
                $direccion_facturacion = $this->obtiene_cliente_direccion_facturacion($id_facturacion);
            } else {
                $direccion_facturacion = null;
            }

            if ($Id_Tipo_Pago > 0) {
                $tipo_pago = $row->tipo_pago;
            } else {
                $tipo_pago = "Todos";
            }
            if ($Id_Tipo_Envio > 0) {
                $tipo_envio = $row->tipo_envio;
            } else {
                $tipo_envio = "Todos";
            }
            if ($Id_Estatus_Pago > 0) {
                $estatus_pago = $row->estatus_pago;
            } else {
                $estatus_pago = "Todos";
            }
            if ($Id_Estatus_Pedido > 0) {
                $estatus_pedido = $row->estatus_pedido;
            } else {
                $estatus_pedido = "Todos";
            }


            $ordenes[] = (object)[
                "Id_Orden" => $row->id_orden,
                "Id_User" => $row->id_user,
                "Nombre" => $row->nombres,
                "Paterno" => $row->paterno,
                "Materno" => $row->materno,
                "Id_Tipo_Pago" => $row->id_tipo_pago,
                "Id_Tipo_Envio" => $row->id_tipo_envio,
                "Id_Estatus_Pago" => $row->id_estatus_pago,
                "Id_Estatus_Pedido" => $row->id_estatus_pedido,
                "Subtotal" => $row->subtotal,
                "Iva" => $row->iva,
                "Envio" => $row->envio,
                "Total" => $row->total,
                "Id_Direccion" => $row->id_direccion,
                "Id_Facturacion" => $row->id_facturacion,
                "Fecha_Pedido" => $row->fecha_pedido,
                "Fecha_Produccion" => $row->fecha_produccion,
                "Fecha_Entrega" => $row->fecha_entrega,
                "Fecha_Enviado" => $row->fecha_enviado,
                "Fecha_Completo" => $row->fecha_completo,
                "Activo" => $row->activo,
                "Tipo_Pago_R" => $tipo_pago,
                "Tipo_Envio_R" => $tipo_envio,
                "Estatus_Pago_R" => $estatus_pago,
                "Estatus_Pedido_R" => $estatus_pedido,
                "Comprobante" => $row->comprobante,
                "Constancia" => $row->constancia,
                "Fecha_Constancia" => $row->fecha_constancia,
                "Tipo_Pago" => $row->tipo_pago,
                "Estatus_Pago" => $row->estatus_pago,
                "Estatus_Pedido" => $row->estatus_pedido,
                "Cat_Tipo_Envio" => $cat_tipo_envio,
                "Cat_Estatus_Pago" => $this->listado_pago(),
                "Direccion_Facturacion" => $direccion_facturacion
            ];
        }

        // echo "<pre>", var_dump($ordenes), "</pre>";


        $data_breadcrumb = array(
            'title' => 'Ordenes Activas',
            'icon' => '<i class="fa-solid fa-file-invoice"></i>'
        );

        $data_main = array(
            'menu' => 'ordenes_activas',
            'ordenes' => $ordenes,
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
