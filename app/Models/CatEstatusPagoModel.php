<?php

namespace App\Models;

use CodeIgniter\Model;

class CatEstatusPagoModel extends Model
{

    protected $table = 'cat_estatus_pago';
    protected $primaryKey = 'id_estatus_pago';
    protected $returnType = 'object';
    protected $allowedFields = ['estatus_pago'];

	public function lista($activo = "")
	{

        $builder = $this->table('cat_estatus_pago');
		if($activo != ""){
			$builder->where("activo", $activo);
		}
		$builder->orderBy("activo", "desc");
		$builder->orderBy("estatus_pago", "asc");
		return $builder->get()->getResult();
	}   
}
