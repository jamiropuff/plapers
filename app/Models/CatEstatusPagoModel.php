<?php

namespace App\Models;

use CodeIgniter\Model;

class CatEstatusPagoModel extends Model {

    protected $table = 'cat_estatus_pago';
    protected $primaryKey = 'id_estatus_pago';
    protected $returnType = 'object';
    protected $allowedFields = ['estatus_pago'];

}