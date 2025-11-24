<?php

namespace App\Models;

use CodeIgniter\Model;

class CatEstatusPedidoModel extends Model
{

	protected $table = 'cat_estatus_pedido';
	protected $primaryKey = 'id_estatus_pedido';
	protected $returnType = 'object';
	protected $allowedFields = ['id_tipo_envio', 'estatus_pedido', 'notifica_cliente', 'notifica_admin', 'texto_correo'];

	public function lista($activo = "")
	{

		$builder = $this->table('cat_estatus_pedido');
		$builder->select('id_estatus_pedido, id_tipo_envio, estatus_pedido, activo');
		if ($activo != "") {
			$builder->where("activo", $activo);
		}
		$builder->orderBy("activo", "desc");
		$builder->orderBy("estatus_pedido", "asc");
		$query = $builder->get();
		$estatus_pedido = [];
		foreach ($query->getResult() as $row) {
			$id_tipo_envio = $row->id_tipo_envio;

			if ($id_tipo_envio == 1) {
				$tipo_envio = 'Envio';
			}
			if ($id_tipo_envio == 2) {
				$tipo_envio = 'Sin Envio';
			}

			$estatus_pedido[] = (object) ["estatus_pedido" => $row->estatus_pedido, "id_estatus_pedido" => $row->id_estatus_pedido, "id_tipo_envio" => $row->id_tipo_envio, "envio" => $tipo_envio, "activo" => $row->activo];
		}
		return $estatus_pedido;
	}

	public function lista_envio($id_tipo_envio = 0)
	{
		$builder = $this->table('cat_estatus_pedido');
		$builder->select('estatus_pedido, id_estatus_pedido, id_tipo_envio, activo');

		if ($id_tipo_envio > 0) {
			$builder->where("id_tipo_envio", $id_tipo_envio);
		} else {
			$builder->where("id_tipo_envio", "1");
		}
		$builder->orderBy("activo", "desc");
		$builder->orderBy("estatus_pedido", "asc");
		$query = $builder->get();
		$estatus_pedido = [];
		foreach ($query->getResult() as $row) {
			$estatus_pedido[] = (object)["estatus_pedido" => $row->estatus_pedido, "id_estatus_pedido" => $row->id_estatus_pedido, "id_tipo_envio" => $row->id_tipo_envio, "activo" => $row->activo];
		}
		return $estatus_pedido;
	}
}
