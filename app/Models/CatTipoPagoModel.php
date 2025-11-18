<?php

namespace App\Models;

use CodeIgniter\Model;

class CatTipoPagoModel extends Model {

    protected $table = 'cat_tipo_pago';
    protected $primaryKey = 'id_tipo_pago';
    protected $returnType = 'object';
    protected $allowedFields = ['tipo_pago'];

}