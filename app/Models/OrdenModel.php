<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdenModel extends Model {

    protected $table = 't_orden';
    protected $primaryKey = 'id_orden';
    protected $returnType = 'object';
    protected $allowedFields = [];

}