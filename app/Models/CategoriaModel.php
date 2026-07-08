<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table      = 'cat_categorias';
    protected $primaryKey = 'id_categoria';

    protected $allowedFields = [
        'nom_categoria',
        'activo'
    ];

    /* =======================
       LISTA CATEGORÍAS
       ======================= */
    public function lista($activo = '')
    {
        $builder = $this->db->table('cat_categorias cc')
            ->select('cc.nom_categoria, cc.id_categoria, cc.activo');

        if ($activo !== '') {
            $builder->where('cc.activo', $activo);
        }

        $builder->orderBy('cc.activo', 'DESC')
                ->orderBy('cc.nom_categoria', 'ASC');

        return $builder->get()->getResultArray();
    }

    /* =======================
       LISTA SUBCATEGORÍAS
       ======================= */
    public function lista_subcategorias($id_categoria, $activo = '')
    {
        $builder = $this->db->table('cat_subcategorias cs')
            ->select('cs.nom_subcategoria, cs.id_subcategoria, cs.activo')
            ->where('cs.id_categoria', $id_categoria);

        if ($activo !== '') {
            $builder->where('cs.activo', $activo);
        }

        $builder->orderBy('cs.activo', 'DESC')
                ->orderBy('cs.nom_subcategoria', 'ASC');

        return $builder->get()->getResultArray();
    }

    /* =======================
       BUSCA CATEGORÍA
       ======================= */
    public function busca($Id_Categoria)
    {
        return $this->db->table('cat_categorias cc')
            ->select('cc.nom_categoria, cc.id_categoria, cc.activo')
            ->where('cc.id_categoria', $Id_Categoria)
            ->get()
            ->getRowArray();
    }

    /* =======================
       AGREGA CATEGORÍA
       ======================= */
    public function agrega_categoria($nom_categoria)
    {
        $result = [
            'Code' => QUERY_SUCCESS,
            'Msg'  => "Se agregó la categoría $nom_categoria"
        ];

        try {
            $this->insert([
                'nom_categoria' => $nom_categoria
            ]);
        } catch (\Throwable $e) {
            $result['Code']  = QUERY_FAILED;
            $result['Msg']   = 'Hubo un error con la base de datos';
            $result['Error'] = $e->getMessage();
        }

        return $result;
    }

    /* =======================
       EDITA CATEGORÍA
       ======================= */
    public function edita_categoria($id_categoria, $nom_categoria)
    {
        $result = [
            'Code' => QUERY_SUCCESS,
            'Msg'  => "Se editó la categoría $nom_categoria"
        ];

        try {
            $this->update($id_categoria, [
                'nom_categoria' => $nom_categoria
            ]);
        } catch (\Throwable $e) {
            $result['Code']  = QUERY_FAILED;
            $result['Msg']   = 'Hubo un error con la base de datos';
            $result['Error'] = $e->getMessage();
        }

        return $result;
    }

    /* =======================
       CAMBIA STATUS
       ======================= */
    public function cambia_status($id_categoria, $estatus)
    {
        $categoria = $this->find($id_categoria);

        if (!$categoria) {
            return [
                'Code' => QUERY_FAILED,
                'Msg'  => 'Categoría no encontrada'
            ];
        }

        $nom_categoria = $categoria['nom_categoria'];

        $result = [
            'Code' => QUERY_SUCCESS,
            'Msg'  => $estatus == 0
                ? "Se desactivó la categoría $nom_categoria"
                : "Se activó la categoría $nom_categoria"
        ];

        try {
            $this->update($id_categoria, [
                'activo' => $estatus
            ]);
        } catch (\Throwable $e) {
            $result['Code']  = QUERY_FAILED;
            $result['Msg']   = 'Hubo un error con la base de datos';
            $result['Error'] = $e->getMessage();
        }

        return $result;
    }
}
