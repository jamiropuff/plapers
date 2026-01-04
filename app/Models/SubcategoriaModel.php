<?php

namespace App\Models;

use CodeIgniter\Model;

class SubcategoriaModel extends Model
{
    protected $table      = 'cat_subcategorias';
    protected $primaryKey = 'id_subcategoria';

    protected $allowedFields = [
        'id_categoria',
        'nom_subcategoria',
        'activo'
    ];

    protected $returnType = 'array';

    /**
     * Lista subcategorías
     */
    public function lista($activo = "")
    {
        $builder = $this->db->table('cat_categorias cc');
        $builder->select('
            cs.id_subcategoria,
            cs.nom_subcategoria,
            cs.id_categoria,
            cc.nom_categoria,
            cs.activo
        ');
        $builder->join('cat_subcategorias cs', 'cc.id_categoria = cs.id_categoria');

        if ($activo !== "") {
            $builder->where('cc.activo', $activo);
        }

        $builder->orderBy('cs.activo', 'DESC');
        $builder->orderBy('cc.nom_categoria', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * Busca una subcategoría
     */
    public function busca($idSubcategoria)
    {
        return $this->select('id_subcategoria, nom_subcategoria, id_categoria')
                    ->where('id_subcategoria', $idSubcategoria)
                    ->first();
    }

    /**
     * Edita subcategoría
     */
    public function edita_subcategoria($idSubcategoria, $nomSubcategoria, $idCategoria)
    {
        $data = [
            'nom_subcategoria' => $nomSubcategoria,
            'id_categoria'     => $idCategoria
        ];

        $result = [
            'Code' => QUERY_SUCCESS,
            'Msg'  => "Se editó la categoría $nomSubcategoria"
        ];

        if (! $this->update($idSubcategoria, $data)) {
            $result['DB_Code'] = QUERY_FAILED;
            $result['Msg']     = 'Hubo un error con la base de datos';
            $result['Error']   = $this->db->error();
        }

        return $result;
    }

    /**
     * Cambia estatus (activo / inactivo)
     */
    public function cambia_status($idSubcategoria, $estatus)
    {
        $subcategoria = $this->select('nom_subcategoria')
                             ->where('id_subcategoria', $idSubcategoria)
                             ->first();

        $result = [
            'Code' => QUERY_SUCCESS,
            'Msg'  => $estatus == 1
                ? "Se activó la categoría {$subcategoria['nom_subcategoria']}"
                : "Se desactivó la categoría {$subcategoria['nom_subcategoria']}"
        ];

        if (! $this->update($idSubcategoria, ['activo' => $estatus])) {
            $result['DB_Code'] = QUERY_FAILED;
            $result['Msg']     = 'Hubo un error con la base de datos';
            $result['Error']   = $this->db->error();
        }

        return $result;
    }

    /**
     * Agrega subcategoría
     */
    public function agrega_subcategoria($idCategoria, $nomSubcategoria)
    {
        $data = [
            'id_categoria'     => $idCategoria,
            'nom_subcategoria' => $nomSubcategoria
        ];

        $result = [
            'Code' => QUERY_SUCCESS,
            'Msg'  => "Se agregó la categoría $nomSubcategoria"
        ];

        if (! $this->insert($data)) {
            $result['DB_Code'] = QUERY_FAILED;
            $result['Msg']     = 'Hubo un error con la base de datos';
            $result['Error']   = $this->db->error();
        }

        return $result;
    }
}
