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

	public function busca($Id_Tipo_Envio)
	{

		$builder = $this->table('cat_tipo_envio');
		$builder->select('tipo_envio, id_tipo_envio, activo');
		$builder->where("id_tipo_envio", $Id_Tipo_Envio);
		$query = $builder->get();

		$tipo_envio = [];
		foreach ($query->getResult() as $row)
		{
			$tipo_envio[] = array("tipo_envio" => $row->tipo_envio, "id_tipo_envio" => $row->id_tipo_envio, "activo" => $row->activo);
		}
		return $tipo_envio;
	}

	public function agrega_tipo_envio($tipo_envio)
	{
		$data = array(
			'tipo_envio' => $tipo_envio
		);

		$builder = $this->table('cat_tipo_envio');
		return $builder->insert($data);
	}


}