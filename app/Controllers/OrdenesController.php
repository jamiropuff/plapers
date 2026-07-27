<?php

namespace App\Controllers;

use App\Models\OrdenModel;
use App\Models\CatTipoPagoModel;
use App\Models\CatEstatusPagoModel;
use App\Models\CatTipoEnvioModel;
use App\Models\CatEstatusPedidoModel;

class OrdenesController extends BaseController
{

    public function ordenes_activas()
    {
        $session = session();

        // 🔐 Validar sesión y rol
        if (!isset($session->Rol) || !in_array($session->Rol, [1, 3, 5])) {
            return redirect()->to('/login');
        }

        $Id_Rol = $session->Rol;

        // 📊 Datos
        $data_main = [
            'menu' => 'ordenes',
        ];

        // 🧭 Breadcrumb
        $data_breadcrumb = [
            'title' => 'Órdenes Activas',
            'icon' => '<i class="fa-solid fa-file-invoice"></i>'
        ];

        // 📎 Sesión
        $data_session = [
            "session" => $session
        ];

        $data_footer = [
            'menu' => 'ordenes'
        ];

        // 🖼️ Vistas
        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/ordenes/activas', $data_main);
        echo view('admin/templates/footer', $data_footer);
        echo view('admin/scripts/ordenes', $data_session);
        echo view('admin/templates/end', $data_footer);
    }

    public function ordenes_activasJSON()
    {
        $session = session();

        // 🔐 Validar sesión y rol
        if (!isset($session->Rol) || !in_array($session->Rol, [1, 3, 5])) {
            return redirect()->to('/login');
        }

        $Id_Rol = $session->Rol;

        // 📥 Filtros (POST)
        if ($this->request->getMethod() === 'post') {
            $Id_Tipo_Pago = (int)$this->request->getPost('id_tipo_pago_search');
            $Id_Estatus_Pago = (int)$this->request->getPost('id_estatus_pago_search');
            $Id_Tipo_Envio = (int)$this->request->getPost('id_tipo_envio_search');
            $Id_Estatus_Pedido = (int)$this->request->getPost('id_estatus_pedido_search');
        } else {
            $Id_Tipo_Pago = 0;
            $Id_Estatus_Pago = 0;
            $Id_Tipo_Envio = 0;
            $Id_Estatus_Pedido = 0;
        }

        // 📦 Modelos de catálogos
        $tipoPagoModel = new CatTipoPagoModel();
        $estatusPagoModel = new CatEstatusPagoModel();
        $tipoEnvioModel = new CatTipoEnvioModel();
        $estatusPedidoModel = new CatEstatusPedidoModel();

        // 📦 Modelo principal
        $ordenModel = new OrdenModel();

        // 📊 Datos
        $response = [
            'menu' => 'ordenes_activas',
            'data' => $ordenModel->obtieneDatosOrden(
                $Id_Rol,
                $Id_Tipo_Pago,
                $Id_Tipo_Envio,
                $Id_Estatus_Pago,
                $Id_Estatus_Pedido
            ),
            'tipoPago' => $tipoPagoModel->lista(),
            'estatusPago' => $estatusPagoModel->lista(),
            'tipoEnvio' => $tipoEnvioModel->lista(),
            'estatusPedido' => $estatusPedidoModel->lista()
        ];

        return $this->response->setJSON($response);
    }

    public function orden($idOrden = null)
    {

        $session = session();
        $data["Titulo"] = "Ficha";


        // Obtener ID desde la URL si no viene como parámetro
        if ($idOrden === null) {
            $idOrden = $this->request->getUri()->getSegment(4);
        }

        if (empty($idOrden)) {
            $data["Msg"]  = "No se encontraron los productos";
            $data["Code"] = INVALID_REQUEST;
        } else {

            $ordenModel = new OrdenModel();

            // Productos de la orden
            $data["Data"] = $ordenModel->obtieneDatosOrdenProducto($idOrden);

            // Tipo de envío
            $data["TipoEnvio"] = $ordenModel->listaEnvio();
        }

        $Id_Rol = $session->Rol;

        // Breadcrumb
        $data_breadcrumb = [
            'title' => 'Órdenes Activas',
            'icon' => '<i class="fa-solid fa-file-invoice"></i>'
        ];

        // Sesión
        $data_session = [
            "session" => $session
        ];

        $data_footer = [
            'menu' => 'ordenes'
        ];

        // echo "<pre>", var_dump($data), "</pre>";

        // Vistas
        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/ordenes/orden', $data);
        echo view('admin/templates/footer', $data_footer);
        // echo view('admin/scripts/ordenes', $data_session);
        echo view('admin/templates/end', $data_footer);
    }

    public function productos()
    {
        $session = session();
        $data["Titulo"] = "Productos";

        $method = $this->request->getMethod(true); // TRUE = uppercase

        if ($method === "GET") {

            $Id_Orden = $this->request->uri->getSegment(4);

            if (empty($Id_Orden)) {

                $data["Msg"]  = "No se encontraron los productos";
                $data["Code"] = INVALID_REQUEST;
            } else {

                $ordenModel = model('App\Models\OrdenModel');

                $data["Productos"] = $ordenModel->obtieneDatosOrdenProducto($Id_Orden);
                $data["TipoEnvio"] = $ordenModel->listaEnvio();
            }
        } else {

            $data["Code"] = METHOD_NOT_ALLOWED;
            $data["Msg"]  = MSG_METHOD_NOT_ALLOWED;
        }

        $Id_Rol = $session->Rol;

        // Breadcrumb
        $data_breadcrumb = [
            'title' => 'Productos',
            'icon' => '<i class="fa-solid fa-box"></i>'
        ];

        // Sesión
        $data_session = [
            "session" => $session
        ];

        $data_footer = [
            'menu' => 'productos'
        ];

        // echo "<pre>", var_dump($data), "</pre>";

        // Vistas
        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/ordenes/producto', $data);
        echo view('admin/templates/footer', $data_footer);
        // echo view('admin/scripts/ordenes', $data_session);
        echo view('admin/templates/end', $data_footer);
    }

    public function ordenes_finalizadas()
    {
        $session = session();

        // 🔐 Validar sesión y rol
        if (!isset($session->Rol) || !in_array($session->Rol, [1, 3, 5])) {
            return redirect()->to('/login');
        }

        $data_main = [
            'menu' => 'ordenes_finalizadas',
        ];

        $data_breadcrumb = [
            'title' => 'Ordenes Finalizadas',
            'icon' => '<i class="fa-solid fa-file-import"></i>'
        ];

        $data_session = [
            "session" => $session
        ];

        $data_footer = [
            'menu' => 'ordenes_finalizadas',
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/ordenes/finalizadas', $data_main);
        echo view('admin/templates/footer', $data_footer);
        echo view('admin/scripts/ordenes', $data_session);
        echo view('admin/templates/end', $data_footer);
    }
    public function ordenes_finalizadasJSON()
    {
        $session = session();
        if (!isset($session->Rol) || !in_array($session->Rol, [1, 3, 5])) {
            return $this->response->setJSON(['Code' => REQUEST_FAILED, 'Msg' => 'No autorizado']);
        }

        $Id_Rol = $session->Rol;

        $RangoFechaInicio = $this->request->getPost('rango_fecha_inicio');
        $RangoFechaFin = $this->request->getPost('rango_fecha_fin');

        $ordenModel = new OrdenModel();
        $response = [
            'Code' => REQUEST_SUCCESS,
            'data' => $ordenModel->obtieneOrdenesFinalizadas($Id_Rol, $RangoFechaInicio, $RangoFechaFin)
        ];
        return $this->response->setJSON($response);
    }

    public function ordenes_canceladas($Id_Rol = 0)
    {
        $session = session();


        $data_breadcrumb = array(
            'title' => 'Ordenes Canceladas',
            'icon' => '<i class="fa-solid fa-file-excel"></i>'
        );

        $data_main = array(
            'menu' => 'ordenes_canceladas'
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
        echo view('admin/templates/footer', $data_footer);
        echo view('admin/scripts/ordenes', $data_session);
        echo view('admin/templates/end', $data_footer);
    }

    public function ordenes_canceladasJSON()
    {
        $session = session();
        if (!isset($session->Rol) || !in_array($session->Rol, [1, 3, 5])) {
            return $this->response->setJSON(['Code' => REQUEST_FAILED, 'Msg' => 'No autorizado']);
        }
        $RangoFechaInicio = $this->request->getPost('fecha_inicio');
        $RangoFechaFin = $this->request->getPost('fecha_fin');

        $Id_Rol = $session->Rol;
        $ordenModel = new OrdenModel();
        $response = [
            'Code' => REQUEST_SUCCESS,
            'data' => $ordenModel->obtieneOrdenesCanceladas($Id_Rol, $RangoFechaInicio, $RangoFechaFin)
        ];
        return $this->response->setJSON($response);
    }


    /***********************************************************/

    public function lista_envio($id_tipo_envio = 0)
    {

        $db = \Config\Database::connect();

        $builder = $db->table('plap_cat_estatus_pedido');
        $builder->select('estatus_pedido, id_estatus_pedido, id_tipo_envio, activo');

        if ($id_tipo_envio > 0) {
            $builder->where("id_tipo_envio", $id_tipo_envio);
        } else {
            $builder->where("id_tipo_envio", "1");
        }

        $builder->orderBy("activo", "desc");
        $builder->orderBy("id_estatus_pedido", "asc");
        $query = $builder->get();

        $estatus_pedido = [];
        foreach ($query->getResult() as $row) {
            $estatus_pedido[] = (object)["id_estatus_pedido" => $row->id_estatus_pedido, "id_tipo_envio" => $row->id_tipo_envio, "estatus_pedido" => $row->estatus_pedido, "activo" => $row->activo];
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
