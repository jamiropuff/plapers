<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaEducativaModel extends Model {

    protected $table = 'oferta_educativa';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id_grado_academico','oferta_educativa','titulo','banner','banner_mobile','banner_posicion','video','descripcion','duracion','inicio_clases','url_plan_estudios','url_opciones_titulacion','url_rvoe','video_activo','titulo_menu','is_deleted','updated_at','fecha_upd'];

}