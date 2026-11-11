<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogosModel extends Model
{

    public function catalogos()
    {
        return array(
            'caracteres' => $this->db->table('plap_cat_caracteres')
                ->select('id_caracter, id_categoria, id_subcategoria, id_fuente, caracteres')
                ->where('activo', 1)
                ->orderBy('id_caracter', 'ASC')
                ->get()->getResultArray(),

            'categorias' => $this->db->table('plap_cat_categorias')
                ->select('id_categoria, nom_categoria')
                ->where('activo', 1)
                ->orderBy('id_categoria', 'ASC')
                ->get()->getResultArray(),

            'colores' => $this->db->table('plap_cat_colores')
                ->select('id_color, color, hex')
                ->where('activo', 1)
                ->orderBy('id_color', 'ASC')
                ->get()->getResultArray(),

            'descuentos' => $this->db->table('plap_cat_descuentos')
                ->select('id_descuento, id_categoria, rango_inicio, rango_fin, precio, descuento, precio_final')
                ->where('activo', 1)
                ->orderBy('id_descuento', 'ASC')
                ->get()->getResultArray(),

            'estados' => $this->db->table('plap_cat_estados')
                ->select('id_estado, nombre_estado')
                ->orderBy('id_estado', 'ASC')
                ->get()->getResultArray(),

            'paises' => $this->db->table('plap_cat_paises')
                ->select('id_pais, nombre_pais')
                ->orderBy('id_pais', 'ASC')
                ->get()->getResultArray(),

            'posiciones' => $this->db->table('plap_cat_posiciones')
                ->select('id_posicion, numero_posicion, id_renglon, id_fuente_linea1, id_fuente_linea2, id_fuente_linea3, caracter1, caracter2, caracter3')
                ->where('activo', 1)
                ->orderBy('id_posicion', 'ASC')
                ->get()->getResultArray(),

            'productos' => $this->db->table('plap_cat_productos')
                ->select('id_producto, id_categoria, id_subcategoria, clave, nom_producto, id_terminado, id_renglon, id_caracter, id_signo, id_color, id_posicion, foto, precio_unitario')
                ->where('activo', 1)
                ->orderBy('id_producto', 'ASC')
                ->get()->getResultArray(),

            'renglones' => $this->db->table('plap_cat_renglones')
                ->select('id_renglon, numero_renglones')
                ->where('activo', 1)
                ->orderBy('id_renglon', 'ASC')
                ->get()->getResultArray(),

            'signos' => $this->db->table('plap_cat_signos')
                ->select('id_signo, nom_signo, signo')
                ->where('activo', 1)
                ->orderBy('id_signo', 'ASC')
                ->get()->getResultArray(),

            'subcategorias' => $this->db->table('plap_cat_subcategorias')
                ->select('id_subcategoria, nom_subcategoria')
                ->where('activo', 1)
                ->orderBy('id_subcategoria', 'ASC')
                ->get()->getResultArray(),

            'terminado' => $this->db->table('plap_cat_terminado')
                ->select('id_terminado, nom_terminado')
                ->where('activo', 1)
                ->orderBy('id_terminado', 'ASC')
                ->get()->getResultArray(),

            'usocfdi' => $this->db->table('plap_cat_uso_cfdi')
                ->select('id_uso, nombre_uso')
                ->orderBy('id_uso', 'ASC')
                ->get()->getResultArray()

        );
    }


    public function obtenerPrecioCheckout(
        int $idProducto,
        int $totalPlacas,
        int $tipoUsuario
    ): array {

        if ($totalPlacas < 1) {
            throw new \RuntimeException('La cantidad total de placas no es válida.');
        }

        // 1. Obtener el producto directamente de MySQL.
        $producto = $this->db->table('plap_cat_productos')
            ->select('id_producto, id_categoria, precio_unitario')
            ->where('id_producto', $idProducto)
            ->where('activo', 1)
            ->get()
            ->getRowArray();

        if (!$producto) {
            throw new \RuntimeException(
                "El producto {$idProducto} no existe o está inactivo."
            );
        }

        // 2. Usuario normal: precio directo del producto.
        if ($tipoUsuario === 1) {

            return [
                'id_producto'      => (int) $producto['id_producto'],
                'id_categoria'     => (int) $producto['id_categoria'],
                'precio_unitario'  => (float) $producto['precio_unitario'],
                'tipo_precio'      => 'NORMAL'
            ];
        }

        // 3. Usuario con descuento.
        if ($tipoUsuario === 2) {

            $descuento = $this->db->table('plap_cat_descuentos')
                ->select('id_descuento, id_categoria, rango_inicio, rango_fin, precio_final')
                ->where('id_categoria', (int) $producto['id_categoria'])
                ->where('rango_inicio <=', $totalPlacas)
                ->where('activo', 1)
                ->groupStart()
                ->where('rango_fin >=', $totalPlacas)
                ->orWhere('rango_fin', -1)
                ->groupEnd()
                ->get()
                ->getRowArray();

            if (!$descuento) {
                throw new \RuntimeException(
                    "No existe un descuento configurado para la categoría "
                        . $producto['id_categoria']
                        . " con {$totalPlacas} placas."
                );
            }

            return [
                'id_producto'      => (int) $producto['id_producto'],
                'id_categoria'     => (int) $producto['id_categoria'],
                'precio_unitario'  => (float) $descuento['precio_final'],
                'id_descuento'     => (int) $descuento['id_descuento'],
                'tipo_precio'      => 'DESCUENTO'
            ];
        }

        throw new \RuntimeException('El tipo de usuario no es válido.');
    }
}
