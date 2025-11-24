<?php

namespace App\Models;

use CodeIgniter\Model;

class CatTipoPagoModel extends Model
{

    protected $table = 'cat_tipo_pago';
    protected $primaryKey = 'id_tipo_pago';
    protected $returnType = 'object';
    protected $allowedFields = ['tipo_pago'];

    public function lista($activo = "")
    {
        $builder = $this->table('cat_tipo_pago');
        $builder->select('id_tipo_pago, tipo_pago, activo');
        if($activo != "") {
            $builder = $builder->where('activo', $activo);
        }
        $builder = $builder->orderBy('activo', 'DESC');
        $builder = $builder->orderBy('tipo_pago', 'ASC');
        return $builder->get()->getResult();
        
    }    
    
    public function busca($Id_Tipo_Pago)
    {
        $builder = $this->table('cat_tipo_pago');
        $builder->select('id_tipo_pago, tipo_pago, activo');
        $builder = $builder->where('id_tipo_pago', $Id_Tipo_Pago);
        $query = $builder->get();
        return $query->getFirstRow();
    }
}
