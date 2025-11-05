<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaPlantelModel extends Model {

    protected $table = 'oferta_educativa_planteles';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa','nombre','is_deleted','updated_at'];

}