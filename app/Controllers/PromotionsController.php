<?php

namespace App\Controllers;

use App\Models\OfertaEducativaModel;
use App\Models\OfertaEducativaPromocionModel;

class PromotionsController extends BaseController
{

    public function promotions() {

        $array_archivos = [];

        $directory = ROOTPATH . 'public/assets/images/promo';
        $dir = dir($directory);
        while (($archivo = $dir->read()) !== false){

            if($archivo != 'img_promociones.png' && $archivo != '.' && $archivo != '..'){
                array_push($array_archivos,$archivo);
            }
            
        }
        $dir->close();

        // Oferta Educativa
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $oferta_educativa = $ofertaEducativaModel->select('id, id_grado_academico, titulo')
        ->where('is_deleted',0)
        ->orderBy('id ASC')
        ->findAll();
    
        // Promociones
        $promocionesModel = new OfertaEducativaPromocionModel();
        $promociones = $promocionesModel->select('id, id_oferta_educativa, promociones, orden, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->orderBy('orden ASC')
        ->findAll();


        $data_promociones = array(
            'archivos' => $array_archivos,
            'oferta_educativa' => $oferta_educativa,
            'promociones' => $promociones,
        );
        
        $data_breadcrumb = array(
            'title' => 'Promociones',
            'icon' => '<i class="fas fa-users"></i>'
        );


        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_breadcrumb);
        echo view('admin/templates/nav-aside',$data_breadcrumb);
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/promotions/default',$data_promociones);
        echo view('admin/templates/footer',$data_breadcrumb);
    }

}