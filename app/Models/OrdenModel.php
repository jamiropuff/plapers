<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdenModel extends Model
{

    protected $table = 't_orden';
    protected $primaryKey = 'id_orden';
    protected $returnType = 'object';
    protected $allowedFields = [];
    protected $DBGroup = 'default';

    public function obtieneDatosOrden(
        $Id_Rol = 0,
        $Id_Tipo_Pago = 0,
        $Id_Tipo_Envio = 0,
        $Id_Estatus_Pago = 0,
        $Id_Estatus_Pedido = 0
    ) {
        if (empty($Id_Rol) && $Id_Rol == 0) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "Rol del Usuario inválido"
            ];
        }

        // Admin, Ventas y Producción
        if (!in_array($Id_Rol, [1, 3, 5])) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "Rol de usuario no permitido"
            ];
        }

        $builder = $this->db->table('plap_t_orden a');

        $builder->select('
            a.id_orden, a.id_user, e.nombres, e.paterno, e.materno,
            a.id_tipo_pago, a.id_tipo_envio, a.id_estatus_pago, a.id_estatus_pedido,
            a.subtotal, a.iva, a.envio, a.total, a.id_direccion, a.id_facturacion,
            a.fecha_pedido, a.fecha_produccion, a.fecha_entrega, a.fecha_enviado,
            a.fecha_completo, a.activo, a.comprobante, a.constancia, a.fecha_constancia,
            b.tipo_pago, c.estatus_pago, d.estatus_pedido
        ');

        $builder->join('plap_cat_tipo_pago b', 'a.id_tipo_pago = b.id_tipo_pago');
        $builder->join('plap_cat_estatus_pago c', 'a.id_estatus_pago = c.id_estatus_pago');
        $builder->join('plap_cat_estatus_pedido d', 'a.id_estatus_pedido = d.id_estatus_pedido');
        $builder->join('plap_t_info_usuarios e', 'a.id_user = e.id_user');

        // Omite cancelados
        $builder->where('a.id_estatus_pago !=', 3);

        if ($Id_Tipo_Pago > 0) {
            $builder->where('a.id_tipo_pago', $Id_Tipo_Pago);
        }

        if ($Id_Tipo_Envio > 0) {
            $builder->where('a.id_tipo_envio', $Id_Tipo_Envio);
        }

        if ($Id_Estatus_Pago > 0) {
            $builder->where('a.id_estatus_pago', $Id_Estatus_Pago);
        }

        if ($Id_Estatus_Pedido > 0) {
            $builder->where('a.id_estatus_pedido', $Id_Estatus_Pedido);
        }

        // Producción
        if ($Id_Rol == 5) {
            $builder->where('(a.id_estatus_pedido = 2 OR a.id_estatus_pedido = 6)');
        } else {
            $builder->where('(a.id_estatus_pedido != 8 AND a.id_estatus_pedido != 9)');
        }

        $builder->orderBy('a.id_orden', 'DESC');

        $query = $builder->get()->getResult();

        $ordenes = [];

        foreach ($query as $row) {

            // Tipo de envío
            if ($row->id_tipo_envio > 0) {
                $cat_tipo_envio = $this->listaEnvio($row->id_tipo_envio);
            } else {
                $cat_tipo_envio = $this->listaEnvio(1);
            }

            // Facturación
            $direccion_facturacion = null;
            if ($row->id_facturacion > 0) {
                $direccion_facturacion = $this->obtieneClienteDireccionFacturacion($row->id_facturacion);
            }

            $ordenes[] = [
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
                "Comprobante" => $row->comprobante,
                "Constancia" => $row->constancia,
                "Fecha_Constancia" => $row->fecha_constancia,
                "Tipo_Pago" => $row->tipo_pago,
                "Estatus_Pago" => $row->estatus_pago,
                "Estatus_Pedido" => $row->estatus_pedido,
                "Cat_Tipo_Envio" => $cat_tipo_envio,
                "Cat_Estatus_Pago" => $this->listadoPago(),
                "Direccion_Facturacion" => $direccion_facturacion
            ];
        }

        return [
            "Code" => REQUEST_SUCCESS,
            "Ordenes" => $ordenes
        ];
    }

    public function obtieneDatosOrdenPorId($Id_Orden)
    {
        $builder = $this->db->table('plap_t_orden a');

        $builder->select('
            a.id_orden, a.id_user, e.nombres, e.paterno, e.materno,
            a.id_tipo_pago, a.id_tipo_envio, a.id_estatus_pago, a.id_estatus_pedido,
            a.subtotal, a.iva, a.envio, a.total, a.id_direccion, a.id_facturacion,
            a.fecha_pedido, a.id_usuario_produccion, a.fecha_produccion,
            a.fecha_entrega, a.id_usuario_fabricado, a.fecha_fabricado,
            a.id_usuario_enviado, a.fecha_enviado, a.id_usuario_finalizado,
            a.fecha_completo, a.id_usuario_pagado, a.fecha_pagado,
            a.id_usuario_cancelado, a.fecha_cancelado,
            a.observaciones_usuario, a.observaciones_plapers,
            a.texto_produccion, a.texto_enviado, a.texto_finalizado,
            a.id_uso, a.activo,
            b.tipo_pago, c.estatus_pago, d.estatus_pedido
        ');

        $builder->join('plap_cat_tipo_pago b', 'a.id_tipo_pago = b.id_tipo_pago');
        $builder->join('plap_cat_estatus_pago c', 'a.id_estatus_pago = c.id_estatus_pago');
        $builder->join('plap_cat_estatus_pedido d', 'a.id_estatus_pedido = d.id_estatus_pedido');
        $builder->join('plap_t_info_usuarios e', 'a.id_user = e.id_user');

        $builder->where('a.id_orden', $Id_Orden);

        $query = $builder->get()->getResultArray();

        return [
            "Code"  => REQUEST_SUCCESS,
            "Orden" => $query
        ];
    }



    public function obtieneDatosOrdenProducto($Id_Orden)
    {
        if (empty($Id_Orden) || $Id_Orden == 0) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "Orden inválida"
            ];
        }

        // =====================================================
        // 1️⃣ ORDEN PRINCIPAL
        // =====================================================
        $orden = $this->obtieneDatosOrdenPorId($Id_Orden);
        $ordenData = $orden['Orden'][0];
        // echo "<pre>", var_dump($ordenData), "</pre>";

        $Id_User_Comprador        = $ordenData['id_user'];
        $Id_Direccion_Envio       = $ordenData['id_direccion'];
        $Id_Direccion_Facturacion = $ordenData['id_facturacion'];
        $Id_Uso                   = $ordenData['id_uso'];

        // =====================================================
        // 2️⃣ PRODUCTOS + TODO JUNTO
        // =====================================================
        $builder = $this->db->table('plap_t_orden_producto a');
        $builder->select('
            a.id_orden_producto, a.id_orden, a.id_producto,
            b.id_categoria, b.id_subcategoria,
            a.nom_categoria, a.nom_producto,
            a.id_posicion,
            a.texto_linea1, a.caracteres_linea1,
            a.texto_linea2, a.caracteres_linea2,
            a.texto_linea3, a.caracteres_linea3,
            a.id_color, a.id_terminado,
            a.foto, a.cantidad, a.precio_unitario, a.total,
            f1.nom_fuente AS fuente1,
            f2.nom_fuente AS fuente2,
            f3.nom_fuente AS fuente3,
            c.color, c.hex,
            t.nom_terminado
        ');

        $builder->join('plap_cat_productos b', 'a.id_producto = b.id_producto');
        $builder->join('plap_cat_fuentes f1', 'a.fuente_linea1 = f1.id_fuente', 'left');
        $builder->join('plap_cat_fuentes f2', 'a.fuente_linea2 = f2.id_fuente', 'left');
        $builder->join('plap_cat_fuentes f3', 'a.fuente_linea3 = f3.id_fuente', 'left');
        $builder->join('plap_cat_colores c', 'a.id_color = c.id_color', 'left');
        $builder->join('plap_cat_terminado t', 'a.id_terminado = t.id_terminado', 'left');

        $builder->where('a.id_orden', $Id_Orden);

        $productos = $builder->get()->getResultArray();

        // echo "<pre>", var_dump($productos), "</pre>";



        // =====================================================
        // 3️⃣ COMPRADOR
        // =====================================================
        $comprador = $this->obtieneDatosClienteId($Id_User_Comprador);
        // echo "<pre>", var_dump($comprador), "</pre>";

        // =====================================================
        // 4️⃣ USUARIOS POR ESTATUS (IN)
        // =====================================================
        $usuariosIds = array_filter([
            $ordenData['Id_Usuario_Produccion'] ?? null,
            $ordenData['Id_Usuario_Fabricado'] ?? null,
            $ordenData['Id_Usuario_Enviado'] ?? null,
            $ordenData['Id_Usuario_Finalizado'] ?? null,
            $ordenData['Id_Usuario_Pagado'] ?? null,
            $ordenData['Id_Usuario_Cancelado'] ?? null,
        ]);

        $usuarios = [];
        if ($usuariosIds) {
            $usuariosData = $this->db->table('plap_t_info_usuarios')
                ->whereIn('id_user', $usuariosIds)
                ->get()->getResultArray();

            foreach ($usuariosData as $u) {
                $usuarios[$u['id_user']] = $u;
            }
        }

        // =====================================================
        // 5️⃣ MAPEO DE USUARIOS
        // =====================================================
        $mapUsuarios = [
            'Id_Usuario_Produccion' => 'Info_Produccion',
            'Id_Usuario_Fabricado' => 'Info_Fabricado',
            'Id_Usuario_Enviado' => 'Info_Enviado',
            'Id_Usuario_Finalizado' => 'Info_Finalizado',
            'Id_Usuario_Pagado' => 'Info_Pagado',
            'Id_Usuario_Cancelado' => 'Info_Cancelado',
        ];

        foreach ($mapUsuarios as $campo => $key) {
            $uid = $ordenData[$campo] ?? null;
            $Response[$key] = $uid && isset($usuarios[$uid]) ? $usuarios[$uid] : [];
        }

        // =====================================================
        // 6️⃣ DIRECCIONES
        // =====================================================
        if ($Id_Direccion_Envio > 0) {
            $direccion_envio = $this->obtieneClienteDireccionEnvio($Id_Direccion_Envio);
            // echo "<pre>", var_dump($direccion_envio), "</pre>";
        }

        if ($Id_Direccion_Facturacion > 0) {
            $direccion_facturacion = $this->obtieneClienteDireccionFacturacion($Id_Direccion_Facturacion);
            // echo "<pre>", var_dump($direccion_facturacion), "</pre>";
        }

        // =====================================================
        // 7️⃣ USO CFDI
        // =====================================================
        if ($Id_Uso > 0) {
            $uso = $this->usoCfdi($Id_Uso);
            $uso_cfdi = $uso[0]['nombre_uso'] ?? null;
        } else {
            $uso_cfdi = null;
        }
        // echo "<pre>", var_dump($uso_cfdi), "</pre>";

        // =====================================================
        // 8️⃣ RESPUESTA FINAL
        // =====================================================
        $Response = array_merge($orden, [
            "Comprador" => $comprador ?? [],
            "Direccion_Envio" => $direccion_envio ?? [],
            "Direccion_Facturacion" => $direccion_facturacion ?? [],
            "Uso_Cfdi" => $uso_cfdi ?? null,
            "Orden_Productos" => $productos
        ]);

        // echo "<pre>", var_dump($Response), "</pre>";

        return $Response;
    }

    public function listaEnvio($id_tipo_envio = 0)
    {
        $builder = $this->db->table('plap_cat_estatus_pedido');

        $builder->select('estatus_pedido, id_estatus_pedido, id_tipo_envio, activo');

        if ($id_tipo_envio > 0) {
            $builder->where('id_tipo_envio', $id_tipo_envio);
        } else {
            $builder->where('id_tipo_envio', 1);
        }

        $builder->orderBy('activo', 'DESC');
        $builder->orderBy('id_estatus_pedido', 'ASC');

        $query = $builder->get()->getResult();

        $estatus_pedido = [];

        foreach ($query as $row) {
            $estatus_pedido[] = [
                "id_estatus_pedido" => $row->id_estatus_pedido,
                "id_tipo_envio"     => $row->id_tipo_envio,
                "estatus_pedido"    => $row->estatus_pedido,
                "activo"            => $row->activo
            ];
        }

        return $estatus_pedido;
    }

    public function listadoPago()
    {
        $builder = $this->db->table('plap_cat_estatus_pago');

        $builder->select('id_estatus_pago, estatus_pago');
        $builder->orderBy('id_estatus_pago', 'ASC');

        $query = $builder->get()->getResult();

        $estatus_pago = [];

        foreach ($query as $row) {
            $estatus_pago[] = [
                "id_estatus_pago" => $row->id_estatus_pago,
                "estatus_pago"    => $row->estatus_pago
            ];
        }

        return $estatus_pago;
    }

    public function obtieneDatosClienteId($Id_User)
    {
        $session = session();
        $Id_Rol = $session->get('Rol');

        if (empty($Id_Rol) || $Id_Rol == 0) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "Rol del Usuario inválido"
            ];
        }

        if (!in_array($Id_Rol, [1, 3, 5])) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "Rol de usuario no permitido"
            ];
        }

        if (empty($Id_User) || $Id_User == 0) {
            return [
                "Code" => REQUEST_FAILED,
                "Msg"  => "ID del Usuario inválido"
            ];
        }

        $builder = $this->db->table('plap_t_usuarios a');

        $builder->select('
        a.id_user, a.username,
        b.nombres, b.paterno, b.materno,
        a.correo_electronico, a.active, a.fecha_add
    ');

        $builder->join('plap_t_info_usuarios b', 'a.id_user = b.id_user');
        $builder->where('a.id_user', $Id_User);

        $builder->orderBy('a.active', 'DESC');
        $builder->orderBy('b.nombres', 'ASC');

        $query = $builder->get()->getResultArray();

        // echo "<pre>", var_dump($query), "</pre>";

        return [
            "Code" => REQUEST_SUCCESS,
            "Clientes" => $query
        ];
    }


    public function obtieneClienteDireccionFacturacion($Id_Direccion_Facturacion)
    {
        $builder = $this->db->table('plap_cat_datos_facturacion');

        $builder->select('
        id_facturacion, razon_social, rfc, curp, calle, numero, interior,
        colonia, municipio, estado, codigo_postal, pais, nombres, paterno,
        materno, uso, tipo_persona, id_user, documento_situacion_fiscal
    ');

        $builder->where('id_facturacion', $Id_Direccion_Facturacion);
        $builder->orderBy('id_facturacion', 'ASC');

        $query = $builder->get()->getResult();

        $direccion_facturacion = [];

        foreach ($query as $row) {

            // Estado
            $arr_estado = $this->estado($row->estado);
            $estado = $arr_estado[0]['Nombre_Estado'] ?? null;

            // País
            $arr_pais = $this->pais($row->pais);
            $pais = $arr_pais[0]['Nombre_Pais'] ?? null;

            // Uso CFDI
            $arr_uso = $this->uso_cfdi($row->uso);
            $uso_cfdi = $arr_uso[0]['nombre_uso'] ?? null;

            $direccion_facturacion[] = [
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

        return $direccion_facturacion;
    }

    public function obtieneClienteDireccionEnvio($Id_Direccion_Envio)
    {
        $builder = $this->db->table('plap_cat_direcciones d');

        $builder->select('
            d.id_direccion, d.calle, d.recibe, d.numero, d.interior, d.colonia,
            d.municipio, d.codigo_postal, d.telefono, d.referencia,
            d.notas_adicionales, d.id_user,
            e.id_estado, e.nombre_estado AS Estado,
            p.id_pais, p.nombre_pais AS Pais
        ');

        $builder->join('plap_cat_estados e', 'd.estado = e.id_estado', 'left');
        $builder->join('plap_cat_paises p', 'd.pais = p.id_pais', 'left');

        $builder->where('d.id_direccion', $Id_Direccion_Envio);

        return $builder->get()->getResultArray();
    }

    public function estado($Id_Estado = 0)
    {
        $builder = $this->db->table('plap_cat_estados');

        $builder->select('id_estado, nombre_estado');
        $builder->where('id_estado', $Id_Estado);
        $builder->orderBy('nombre_estado', 'ASC');

        $query = $builder->get()->getResult();

        $estado = [];

        foreach ($query as $row) {
            $estado[] = [
                "Id_Estado" => $row->id_estado,
                "Nombre_Estado" => $row->nombre_estado
            ];
        }

        return $estado;
    }

    public function pais($Id_Pais = 0)
    {
        $builder = $this->db->table('plap_cat_paises');

        $builder->select('id_pais, nombre_pais');
        $builder->where('id_pais', $Id_Pais);
        $builder->orderBy('nombre_pais', 'ASC');

        $query = $builder->get()->getResult();

        $pais = [];

        foreach ($query as $row) {
            $pais[] = [
                "Id_Pais" => $row->id_pais,
                "Nombre_Pais" => $row->nombre_pais
            ];
        }

        return $pais;
    }

    public function usoCfdi($Id_Uso = 0)
    {
        $builder = $this->db->table('plap_cat_uso_cfdi');

        $builder->select('id_uso, nombre_uso');
        $builder->where('id_uso', $Id_Uso);
        $builder->orderBy('id_uso', 'ASC');

        $query = $builder->get()->getResult();

        $uso = [];

        foreach ($query as $row) {
            $uso[] = [
                "id_uso" => $row->id_uso,
                "nombre_uso" => $row->nombre_uso
            ];
        }

        return $uso;
    }

    public function colores($Id_Color = 0)
    {
        $builder = $this->db->table('plap_cat_colores');

        $builder->select('id_color, color, hex');
        $builder->where('id_color', $Id_Color);
        $builder->orderBy('id_color', 'ASC');

        $query = $builder->get()->getResult();

        $colores = [];

        foreach ($query as $row) {
            $colores[] = [
                "Id_Color" => $row->id_color,
                "Color" => $row->color,
                "Hex" => $row->hex
            ];
        }

        return $colores;
    }
}
