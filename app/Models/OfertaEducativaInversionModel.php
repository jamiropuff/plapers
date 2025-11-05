<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaInversionModel extends Model {

    protected $table = 'oferta_educativa_inversion';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa','inversion','is_deleted','updated_at'];

}