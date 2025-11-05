<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaPlantelInfoModel extends Model {

    protected $table = 'oferta_educativa_planteles_info';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_oferta_educativa','id_oferta_educativa_planteles','info','is_deleted','updated_at'];

}