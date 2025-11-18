<?php

namespace App\Models;

use CodeIgniter\Model;

class CatEstatusPedidoModel extends Model {

    protected $table = 'cat_estatus_pedido';
    protected $primaryKey = 'id_estatus_pedido';
    protected $returnType = 'object';
    protected $allowedFields = ['id_tipo_envio','estatus_pedido','notifica_cliente','notifica_admin','texto_correo'];

}