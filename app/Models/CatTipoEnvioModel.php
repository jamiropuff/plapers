<?php

namespace App\Models;

use CodeIgniter\Model;

class CatTipoEnvioModel extends Model {

    protected $table = 'cat_tipo_envio';
    protected $primaryKey = 'id_tipo_envio';
    protected $returnType = 'object';
    protected $allowedFields = ['tipo_envio'];

	public function lista($activo = "")
	{
        $builder = $this->table('cat_tipo_envio');
		if($activo != ""){
			$builder->where("activo", $activo);
		}
		$builder->orderBy("activo", "desc");
		$builder->orderBy("tipo_envio", "asc");
		return $builder->get()->getResult();
	}   

}