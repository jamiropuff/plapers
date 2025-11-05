<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaPromocionModel extends Model {

    protected $table = 'oferta_educativa_promociones';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa','promociones','orden','is_deleted','updated_at'];

}