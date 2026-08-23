<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriaModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    public function obtiene_galeria()
    {
        $builder = $this->db->table('plap_t_galeria a');

        $builder->select('
            a.id_galeria,
            a.id_producto,
            a.foto,
            b.id_categoria,
            b.id_subcategoria,
            b.nom_producto,
            c.nom_categoria,
            d.nom_subcategoria
        ');

        $builder->join('plap_cat_productos b', 'a.id_producto = b.id_producto');
        $builder->join('plap_cat_categorias c', 'b.id_categoria = c.id_categoria');
        $builder->join('plap_cat_subcategorias d', 'b.id_subcategoria = d.id_subcategoria');

        $builder->orderBy('a.id_galeria', 'ASC');

        $query = $builder->get();

        $galeria = [];

        $response = [
            'Code' => REQUEST_SUCCESS,
            'Msg' => 'Galeria',
            'Galeria' => []
        ];

        foreach ($query->getResult() as $row) {
            $galeria[] = [
                'id_galeria'       => $row->id_galeria,
                'id_producto'      => $row->id_producto,
                'foto'             => $row->foto,
                'id_categoria'     => $row->id_categoria,
                'id_subcategoria'  => $row->id_subcategoria,
                'nom_producto'     => $row->nom_producto,
                'nom_categoria'    => $row->nom_categoria,
                'nom_subcategoria' => $row->nom_subcategoria,
            ];
        }

        $response['Galeria'] = $galeria;

        return $response;
    }
}