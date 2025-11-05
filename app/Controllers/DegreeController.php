<?php

namespace App\Controllers;

use App\Models\ContadorModel;
use App\Models\OfertaEducativaModel;

class DegreeController extends BaseController
{
    // Educative offer
    public function oferta_educativa() {

        // Contador de Visitas
        $contadorModel = new ContadorModel();
        $visitas = $contadorModel->findColumn('visitas');

        // Oferta Educativa para el menú
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $menu_oferta = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->findAll();

        $data_breadcrumb = array(
            'title' => 'Oferta Educativa',
        );

        $data_footer = array(
            'grade' => '',
            'menu' => 'oferta_educativa',
            'visitas' => $visitas,
            'menu_oferta' => $menu_oferta
        );

        echo view('templates/header');
        echo view('templates/nav-top',$data_footer);
        echo view('templates/sidebar-right');
        //echo view('degree/banner',$data_breadcrumb);
        echo view('degree/oferta-edu',$data_breadcrumb);
        echo view('templates/footer',$data_footer);
        echo view('scripts/degree',$data_footer);
        echo view('scripts/scripts');
        echo view('templates/close');
    }

    // Este método es para mostrar la información que viene del menú en la oferta educativa
    public function oferta_show() {

        // Contador de Visitas
        $contadorModel = new ContadorModel();
        $visitas = $contadorModel->findColumn('visitas');


        // Recuperamos la oferta educativa del (:any)
        $oferta_educativa = $this->request->getPath();
        //echo "oferta_educativa: ".$oferta_educativa."<br>";

        // Oferta Educativa para el menú
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $menu_oferta = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->findAll();
        
        $menu_oferta_individual = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->where('oferta_educativa',$oferta_educativa)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->first();

        $titulo = '';
        if(isset($menu_oferta_individual->titulo) && $menu_oferta_individual->titulo != ''){
            $titulo = $menu_oferta_individual->titulo;
        }

        //echo "<pre>", var_dump($menu_oferta_individual), "</pre>";
        $grade = "";
        if( isset($menu_oferta_individual->id_grado_academico) ) {
            if($menu_oferta_individual->id_grado_academico == 1) {
                $grade = "Bachillerato";
            }
            if($menu_oferta_individual->id_grado_academico == 2) {
                $grade = "Licenciaturas";
            }
            if($menu_oferta_individual->id_grado_academico == 3) {
                $grade = "Maestrías";
            }
            if($menu_oferta_individual->id_grado_academico == 4) {
                $grade = "Doctorados";
            }
        }

        $data_breadcrumb = array(
            'title' => $titulo,
            'grade' => $grade,
        );

        $data_footer = array(
            'grade' => $grade,
            'menu' => $oferta_educativa,
            'visitas' => $visitas,
            'menu_oferta' => $menu_oferta
        );

        echo view('templates/header');
        echo view('templates/nav-top',$data_footer);
        echo view('templates/sidebar-right');
        echo view('degree/banner',$data_breadcrumb);
        echo view('degree/oferta_educativa');
        echo view('templates/footer',$data_footer);
        echo view('scripts/degree',$data_footer);
        echo view('scripts/scripts');
        echo view('templates/close');
    }

    // Degree Programs
    public function licenciaturas() {

        // Contador de Visitas
        $contadorModel = new ContadorModel();
        $visitas = $contadorModel->findColumn('visitas');

        // Oferta Educativa para el menú
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $menu_oferta = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->findAll();

        $data_breadcrumb = array(
            'title' => 'Licenciaturas',
        );

        $data_footer = array(
            'grade' => '',
            'menu' => 'licenciaturas',
            'visitas' => $visitas,
            'menu_oferta' => $menu_oferta
        );

        echo view('templates/header');
        echo view('templates/nav-top',$data_footer);
        echo view('templates/sidebar-right');
        //echo view('degree/banner',$data_breadcrumb);
        echo view('degree/licenciaturas',$data_breadcrumb);
        echo view('templates/footer',$data_footer);
        echo view('scripts/degree',$data_footer);
        echo view('scripts/scripts');
        echo view('templates/close');
    }

    // Master's Degrees
    public function maestrias() {

        // Contador de Visitas
        $contadorModel = new ContadorModel();
        $visitas = $contadorModel->findColumn('visitas');

        // Oferta Educativa para el menú
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $menu_oferta = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->findAll();

        $data_breadcrumb = array(
            'title' => 'Maestrías',
        );

        $data_footer = array(
            'grade' => '',
            'menu' => 'maestrias',
            'visitas' => $visitas,
            'menu_oferta' => $menu_oferta
        );

        echo view('templates/header');
        echo view('templates/nav-top',$data_footer);
        echo view('templates/sidebar-right');
        //echo view('degree/banner',$data_breadcrumb);
        echo view('degree/maestrias',$data_breadcrumb);
        echo view('templates/footer',$data_footer);
        echo view('scripts/degree',$data_footer);
        echo view('scripts/scripts');
        echo view('templates/close');
    }

    // Doctorate
    public function doctorados() {

        // Contador de Visitas
        $contadorModel = new ContadorModel();
        $visitas = $contadorModel->findColumn('visitas');

        // Oferta Educativa para el menú
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $menu_oferta = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->findAll();

        $data_breadcrumb = array(
            'title' => 'Doctorado',
        );

        $data_footer = array(
            'grade' => '',
            'menu' => 'doctorados',
            'visitas' => $visitas,
            'menu_oferta' => $menu_oferta
        );

        echo view('templates/header');
        echo view('templates/nav-top',$data_footer);
        echo view('templates/sidebar-right');
        //echo view('degree/banner',$data_breadcrumb);
        echo view('degree/doctorados',$data_breadcrumb);
        echo view('templates/footer',$data_footer);
        echo view('scripts/degree',$data_footer);
        echo view('scripts/scripts');
        echo view('templates/close');
    }

    // Bachelorship
    public function bachillerato() {

        // Contador de Visitas
        $contadorModel = new ContadorModel();
        $visitas = $contadorModel->findColumn('visitas');

        // Oferta Educativa para el menú
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $menu_oferta = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->findAll();

        $data_breadcrumb = array(
            'title' => 'Bachillerato',
        );

        $data_footer = array(
            'grade' => '',
            'menu' => 'bachillerato',
            'visitas' => $visitas,
            'menu_oferta' => $menu_oferta
        );

        echo view('templates/header');
        echo view('templates/nav-top',$data_footer);
        echo view('templates/sidebar-right');
        //echo view('degree/banner',$data_breadcrumb);
        echo view('degree/bachillerato',$data_breadcrumb);
        echo view('templates/footer',$data_footer);
        echo view('scripts/degree',$data_footer);
        echo view('scripts/scripts');
        echo view('templates/close');
    }

}