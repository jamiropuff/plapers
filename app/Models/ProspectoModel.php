<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdenModel extends Model {

    protected $table = 't_orden';
    protected $primaryKey = 'id_orden';
    protected $returnType = 'object';
    protected $allowedFields = ['id_user','id_tipo_pago','id_tipo_envio','id_estatus_pago','id_estatus_pedido','subtotal','iva','envio','total','id_direccion','id_facturacion'];

}