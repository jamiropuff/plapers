<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogosModel extends Model {

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

}