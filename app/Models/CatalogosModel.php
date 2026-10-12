<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogosModel extends Model {

    public function catalogos()
    {
        return array(
            'terminado' => $this->db->table('plap_cat_terminado')
                ->select('id_terminado, nom_terminado')
                ->where('activo', 1)
                ->orderBy('id_terminado', 'ASC')
                ->get()->getResultArray(),
            'renglones' => $this->db->table('plap_cat_renglones')
                ->select('id_renglon, numero_renglones')
                ->where('activo', 1)
                ->orderBy('id_renglon', 'ASC')
                ->get()->getResultArray(),
            'posiciones' => $this->db->table('plap_cat_posiciones')
                ->select('id_posicion, numero_posicion, id_renglon, id_fuente_linea1, id_fuente_linea2, id_fuente_linea3, caracter1, caracter2, caracter3')
                ->where('activo', 1)
                ->orderBy('id_posicion', 'ASC')
                ->get()->getResultArray(),
            'caracteres' => $this->db->table('plap_cat_caracteres')
                ->select('id_caracter, id_categoria, id_subcategoria, id_fuente, caracteres')
                ->where('activo', 1)
                ->orderBy('id_caracter', 'ASC')
                ->get()->getResultArray(),
            'signos' => $this->db->table('plap_cat_signos')
                ->select('id_signo, nom_signo, signo')
                ->where('activo', 1)
                ->orderBy('id_signo', 'ASC')
                ->get()->getResultArray(),
            'colores' => $this->db->table('plap_cat_colores')
                ->select('id_color, color, hex')
                ->where('activo', 1)
                ->orderBy('id_color', 'ASC')
                ->get()->getResultArray(),
            'usocfdi' => $this->db->table('plap_cat_uso_cfdi')
                ->select('id_uso, nombre_uso')
                ->orderBy('id_uso', 'ASC')
                ->get()->getResultArray()
            
        );
    }

}