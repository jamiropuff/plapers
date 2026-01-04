<?php

namespace App\Models;

use CodeIgniter\Model;

class ReporteModel extends Model
{

    protected $table = 't_orden';
    protected $primaryKey = 'id_orden';
    protected $returnType = 'object';
    protected $allowedFields = [];


    public function obtiene_reporte($Id_Rol = 0, $Id_Categoria = 0, $Id_Subcategoria = 0, $Id_Producto = 0, $Id_Tipo_Pago = 0, $Id_Tipo_Envio = 0, $Id_Estatus_Pago = 0, $Id_Estatus_Pedido = 0, $Fecha_Inicio = 0, $Fecha_Fin = 0)
    {
        if (empty($Id_Rol) && $Id_Rol == 0) {
            $Response["Code"] = REQUEST_FAILED;
            $Response["Msg"] = "Rol del Usuario inválido";
        } else {

            if ($Id_Rol == 1 || $Id_Rol == 3) {

                $db = \Config\Database::connect();

                // Builder principal
                $builder = $db->table('plap_t_orden a');
                $builder->select("
                    a.id_orden, a.id_user,
                    e.nombres, e.paterno, e.materno,
                    a.id_tipo_pago, a.id_tipo_envio,
                    a.id_estatus_pago, a.id_estatus_pedido,
                    a.subtotal, a.iva, a.envio, a.total,
                    a.id_direccion, a.id_facturacion,
                    a.fecha_pedido, a.fecha_produccion,
                    a.fecha_enviado, a.fecha_completo,
                    a.activo,
                    b.tipo_pago,
                    j.tipo_envio,
                    c.estatus_pago,
                    d.estatus_pedido,
                    f.id_producto,
                    g.id_categoria,
                    h.nom_categoria,
                    g.id_subcategoria,
                    i.nom_subcategoria,
                    g.clave,
                    g.nom_producto,
                    SUM(f.cantidad) AS cantidad,
                    (SUM(f.precio_unitario) / 1.16) AS precio,
                    ((SUM(f.precio_unitario) / 1.16) * 0.16) AS iva,
                    SUM(f.total) AS total_suma
                ", false);

                /* =======================
                JOINS
                ======================= */
                $builder->join('plap_cat_tipo_pago b', 'a.id_tipo_pago = b.id_tipo_pago');
                $builder->join('plap_cat_estatus_pago c', 'a.id_estatus_pago = c.id_estatus_pago');
                $builder->join('plap_cat_estatus_pedido d', 'a.id_estatus_pedido = d.id_estatus_pedido');
                $builder->join('plap_t_info_usuarios e', 'a.id_user = e.id_user');

                $builder->join('plap_t_orden_producto f', 'a.id_orden = f.id_orden');
                $builder->join('plap_cat_productos g', 'f.id_producto = g.id_producto');
                $builder->join('plap_cat_categorias h', 'g.id_categoria = h.id_categoria');
                $builder->join('plap_cat_subcategorias i', 'g.id_subcategoria = i.id_subcategoria');
                $builder->join('plap_cat_tipo_envio j', 'a.id_tipo_envio = j.id_tipo_envio');

                /* =======================
                FILTROS DINÁMICOS
                ======================= */
                if ($Id_Categoria > 0) {
                    $builder->where('g.id_categoria', $Id_Categoria);
                }

                if ($Id_Subcategoria > 0) {
                    $builder->where('g.id_subcategoria', $Id_Subcategoria);
                }

                if ($Id_Producto > 0) {
                    $builder->where('g.id_producto', $Id_Producto);
                }

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

                if (!empty($Fecha_Inicio)) {
                    $builder->where('a.fecha_pedido >=', $Fecha_Inicio);

                    if (!empty($Fecha_Fin)) {
                        $builder->where('a.fecha_pedido <=', $Fecha_Fin);
                    }
                }

                /* =======================
                GROUP & ORDER
                ======================= */
                $builder->groupBy('f.id_producto');
                $builder->orderBy('a.fecha_pedido', 'DESC');

                /* =======================
                EJECUTAR
                ======================= */
                $query = $builder->get();
                $rows = $query->getResult();

                $ventas = [];
                $Response["Code"] = REQUEST_SUCCESS;
                $Msg = "Ventas";

                if (!empty($rows)) {

                    foreach ($rows as $row) {

                        $tipo_pago       = ($Id_Tipo_Pago > 0) ? $row->tipo_pago : 'Todos';
                        $tipo_envio      = ($Id_Tipo_Envio > 0) ? $row->tipo_envio : 'Todos';
                        $estatus_pago    = ($Id_Estatus_Pago > 0) ? $row->estatus_pago : 'Todos';
                        $estatus_pedido  = ($Id_Estatus_Pedido > 0) ? $row->estatus_pedido : 'Todos';

                        $ventas[] = [
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
                            "Fecha_Enviado" => $row->fecha_enviado,
                            "Fecha_Completo" => $row->fecha_completo,
                            "Activo" => $row->activo,
                            "Tipo_Pago" => $tipo_pago,
                            "Tipo_Envio" => $tipo_envio,
                            "Estatus_Pago" => $estatus_pago,
                            "Estatus_Pedido" => $estatus_pedido,
                            "Id_Producto" => $row->id_producto,
                            "Id_Categoria" => $row->id_categoria,
                            "Nom_Categoria" => $row->nom_categoria,
                            "Id_Subcategoria" => $row->id_subcategoria,
                            "Nom_Subcategoria" => $row->nom_subcategoria,
                            "Clave" => $row->clave,
                            "Nom_Producto" => $row->nom_producto,
                            "Cantidad" => $row->cantidad,
                            "Precio" => number_format($row->precio, 2, ',', '.'),
                            "Iva" => number_format($row->iva, 2, ',', '.'),
                            "Total_Suma" => number_format($row->total_suma, 2, ',', '.')
                        ];
                    }

                    $Response = $ventas;
                } else {
                    $Response = [
                        "error_message" => "no se encontraron registros."
                    ];
                }
            } else {
                $Response["Code"] = REQUEST_FAILED;
                $Response["Msg"] = "Rol de usuario no permitido";
            }
        }
        return $Response;
    }
}
