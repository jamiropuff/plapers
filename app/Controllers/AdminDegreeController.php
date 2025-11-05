<?php

namespace App\Controllers;

use App\Models\GradoAcademicoModel;
use App\Models\OfertaEducativaModel;
use App\Models\OfertaEducativaPlantelModel;
use App\Models\OfertaEducativaPlantelInfoModel;
use App\Models\OfertaEducativaInscripcionModel;
use App\Models\OfertaEducativaInversionModel;
use App\Models\OfertaEducativaPromocionModel;
use App\Models\OfertaEducativaEventosModel;
use App\Models\OfertaEducativaInstalacionesModel;

class AdminDegreeController extends BaseController
{

    public function degree() {
        
        $data_breadcrumb = array(
            'title' => 'Oferta Educativa',
            'icon' => '<i class="fas fa-book-reader"></i>'
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_breadcrumb);
        echo view('admin/templates/nav-aside',$data_breadcrumb);
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/degree/default');
        echo view('admin/templates/footer',$data_breadcrumb);
    }

    public function add() {

        $ofertaEducativaModel = new OfertaEducativaModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $grado_academico_id = $this->request->getPost('grado_academico_id');
        $titulo = $this->request->getPost('titulo');

        // Creamos el nombre para acceder al menú
        $oferta_titulo_acentos = $this->eliminar_acentos($titulo);
        $oferta_titulo_lower = strtolower($oferta_titulo_acentos);
        $oferta_educativa = str_replace(' ', '', $oferta_titulo_lower);
        

        $oferta_action = $ofertaEducativaModel->insert( 
            [
                'id_grado_academico' => $grado_academico_id,
                'oferta_educativa' => $oferta_educativa,
                'titulo' => $titulo,
            ]
        );

        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Inscripción agregada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function edit($id = '') {
        //echo "id: ".$id;

        // Oferta Educativa
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $oferta_educativa = $ofertaEducativaModel->select('id, id_grado_academico, titulo, banner, banner_mobile, banner_posicion, video, descripcion, duracion, inicio_clases,, url_plan_estudios, url_opciones_titulacion, url_rvoe, video_activo, titulo_menu, updated_at')
        ->where('id',$id)
        ->first();

        // Inscripción
        $inscripcionModel = new OfertaEducativaInscripcionModel();
        
        $inscripcion = $inscripcionModel->select('id, id_oferta_educativa, url, descripcion, updated_at')
        ->where('id_oferta_educativa',$id)
        ->where('is_deleted',0)
        ->findAll();

        // Inversión
        $inversionModel = new OfertaEducativaInversionModel();
        
        $inversion = $inversionModel->select('id, id_oferta_educativa, inversion, updated_at')
        ->where('id_oferta_educativa',$id)
        ->where('is_deleted',0)
        ->findAll();

        // Planteles
        $data_planteles = [];
        $plantelesModel = new OfertaEducativaPlantelModel();
        
        // Todos los demás
        $planteles = $plantelesModel->select('id, id_oferta_educativa, nombre, updated_at')
        ->where('id_oferta_educativa',$id)
        ->where('is_deleted',0)
        ->orderBy('id_oferta_educativa ASC','id ASC')
        ->findAll();


        $plantelesInfoModel = new OfertaEducativaPlantelInfoModel();

        foreach($planteles as $plantel){

            $id_oferta_educativa_plantel = $plantel->id;
            // echo "id_oferta_educativa: ".$id."<br>";
            // echo "id_oferta_educativa_plantel: ".$id_oferta_educativa_plantel."<br>";

            $planteles_info = $plantelesInfoModel->select('id, id_oferta_educativa, id_oferta_educativa_planteles, info, updated_at')
            ->where('is_deleted = ', 0)
            ->where('id_oferta_educativa',$id)
            ->where('id_oferta_educativa_planteles', $id_oferta_educativa_plantel)
            ->findAll();

            //->countAllResults();
            //echo $plantelesInfoModel->getLastQuery();
            //echo "planteles_info: ".$planteles_info."<br>";

            //$total_info = $plantelesInfoModel->countAll();
            //echo "total_info: ".$total_info."<br>";

            //var_dump($planteles_info);
            
            $data_planteles[] = array(
                'id' => $plantel->id,
                'id_oferta_educativa' => $plantel->id_oferta_educativa,
                'nombre' => $plantel->nombre,
                'updated_at' => $plantel->updated_at,
                'info' => $planteles_info,
            );
        }

        // Promociones
        $promocionesModel = new OfertaEducativaPromocionModel();
        $promociones = $promocionesModel->select('id, id_oferta_educativa, promociones, orden, is_deleted, updated_at')
        ->where('id_oferta_educativa',$id)
        ->where('is_deleted',0)
        ->orderBy('orden ASC')
        ->findAll();


        // Eventos
        $eventosModel = new OfertaEducativaEventosModel();
        $eventos = $eventosModel->select('id, id_oferta_educativa, imagen, titulo, fecha_inicio, fecha_fin, orden, is_deleted, updated_at')
        ->where('id_oferta_educativa',$id)
        ->where('is_deleted',0)
        ->orderBy('orden ASC')
        ->findAll();

        // Instalaciones
        $instalacionesModel = new OfertaEducativaInstalacionesModel();
        $instalaciones = $instalacionesModel->select('id, id_oferta_educativa, texto, orden, is_deleted, updated_at')
        ->where('id_oferta_educativa',$id)
        ->where('is_deleted',0)
        ->orderBy('id ASC')
        ->findAll();



        $data_oferta_educativa = array(
            'oferta_educativa' => $oferta_educativa,
            'inscripcion' => $inscripcion,
            'inversion' => $inversion,
            'planteles' => $data_planteles,
            'promociones' => $promociones,
            'eventos' => $eventos,
            'instalaciones' => $instalaciones
        );

        
        $data_breadcrumb = array(
            'title' => 'Oferta Educativa',
            'icon' => '<i class="fas fa-book-reader"></i>',
            'seccion' => 'oferta_edit'
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_breadcrumb);
        echo view('admin/templates/nav-aside',$data_breadcrumb);
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/degree/edit',$data_oferta_educativa);
        echo view('admin/templates/footer',$data_breadcrumb);
    }


    public function update_info_general() {

        $ofertaEducativaModel = new OfertaEducativaModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $titulo_menu = $this->request->getPost('titulo_menu');
        $titulo = $this->request->getPost('titulo');

        // Creamos el nombre para acceder al menú desde codeigniter
        $oferta_titulo_acentos = $this->eliminar_acentos($titulo);
        $oferta_titulo_lower = strtolower($oferta_titulo_acentos);
        $oferta_educativa = str_replace(' ', '-', $oferta_titulo_lower);

        $duracion = $this->request->getPost('duracion');
        $inicio_clases = $this->request->getPost('inicio_clases');
        $descripcion = $this->request->getPost('descripcion');


        // Archivo Plan estudios
        if(isset($_FILES['plan_estudios']['name'])){
            $file_name = $_FILES['plan_estudios']['name'];
            $file_tmp = $this->request->getFile('plan_estudios');
            $file_tmp->move(ROOTPATH . 'public/pdf', $file_name);

            if($file_tmp->hasMoved()){ 
                $plan_estudios_action = $ofertaEducativaModel->update($oferta_educativa_id, 
                    [
                        'url_plan_estudios' => $file_name
                    ]
                );
            }
        }

        // Archivo Opciones Titulacion
        if(isset($_FILES['opciones_titulacion']['name'])){
            $file_name = $_FILES['opciones_titulacion']['name'];
            $file_tmp = $this->request->getFile('opciones_titulacion');
            $file_tmp->move(ROOTPATH . 'public/assets/images/titulacion', $file_name);

            if($file_tmp->hasMoved()){ 
                $opciones_titulacion_action = $ofertaEducativaModel->update($oferta_educativa_id, 
                    [
                        'url_opciones_titulacion' => $file_name
                    ]
                );
            }
        }

        // Archivo RVOE
        if(isset($_FILES['rvoe']['name'])){
            $file_name = $_FILES['rvoe']['name'];
            $file_tmp = $this->request->getFile('rvoe');
            $file_tmp->move(ROOTPATH . 'public/pdf', $file_name);

            if($file_tmp->hasMoved()){ 
                $rvoe_action = $ofertaEducativaModel->update($oferta_educativa_id, 
                    [
                        'url_rvoe' => $file_name
                    ]
                );
            }
        }

                   
        $oferta_action = $ofertaEducativaModel->update($oferta_educativa_id, 
            [
                'oferta_educativa' => $oferta_educativa,
                'titulo_menu' => $titulo_menu,
                'titulo' => $titulo,
                'duracion' => $duracion,
                'inicio_clases' => $inicio_clases,
                'descripcion' => $descripcion
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Registro actualizado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function update_banners() {

        $ofertaEducativaModel = new OfertaEducativaModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $banner_posicion = $this->request->getPost('banner_posicion');

        // Archivo Banner
        if(isset($_FILES['banner']['name'])){
            $file_name = $_FILES['banner']['name'];
            $file_tmp = $this->request->getFile('banner');
            $file_tmp->move(ROOTPATH . 'public/assets/images/page-banner', $file_name);

            if($file_tmp->hasMoved()){ 
                $banner_action = $ofertaEducativaModel->update($oferta_educativa_id, 
                    [
                        'banner' => $file_name
                    ]
                );
            }
        }

        // Archivo Banner Movil
        if(isset($_FILES['banner_movil']['name'])){
            $file_name = $_FILES['banner_movil']['name'];
            $file_tmp = $this->request->getFile('banner_movil');
            $file_tmp->move(ROOTPATH . 'public/assets/images/page-banner', $file_name);

            if($file_tmp->hasMoved()){ 
                $banner_movil_action = $ofertaEducativaModel->update($oferta_educativa_id, 
                    [
                        'banner_mobile' => $file_name
                    ]
                );
            }
        }

                   
        $oferta_action = $ofertaEducativaModel->update($oferta_educativa_id, 
            [
                'banner_posicion' => $banner_posicion,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Banners actualizados con éxito.',
            );
        }
        
        return json_encode($response);
        
    }

    public function update_video() {

        $ofertaEducativaModel = new OfertaEducativaModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $video = $this->request->getPost('video');
        $video_activo = $this->request->getPost('video_activo');

                   
        $oferta_action = $ofertaEducativaModel->update($oferta_educativa_id, 
            [
                'video' => $video,
                'video_activo' => $video_activo,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Video actualizado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function insert_inscripcion() {

        $ofertaEducativaModel = new OfertaEducativaInscripcionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $descripcion = $this->request->getPost('descripcion');

        // Archivo Inscripción
        if(isset($_FILES['archivo_inscripcion']['name'])){
            $file_name = $_FILES['archivo_inscripcion']['name'];
            $file_tmp = $this->request->getFile('archivo_inscripcion');
            $file_tmp->move(ROOTPATH . 'public/pdf', $file_name);

            if($file_tmp->hasMoved()){ 
                $oferta_action = $ofertaEducativaModel->insert( 
                    [
                        'id_oferta_educativa' => $oferta_educativa_id,
                        'url' => $file_name,
                        'descripcion' => $descripcion,
                    ]
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'error',
                    'message_text' => 'Ocurrio un error al intentar agregar la información',
                );
    
            }
        }

        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Inscripción agregada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function update_inscripcion() {

        $ofertaEducativaModel = new OfertaEducativaInscripcionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $inscripcion_id = $this->request->getPost('inscripcion_id');
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $descripcion = $this->request->getPost('descripcion');

        // Archivo Inscripción
        if(isset($_FILES['archivo_inscripcion']['name'])){
            $file_name = $_FILES['archivo_inscripcion']['name'];
            $file_tmp = $this->request->getFile('archivo_inscripcion');
            $file_tmp->move(ROOTPATH . 'public/pdf', $file_name);

            if($file_tmp->hasMoved()){ 
                $archivo_inscripcion_action = $ofertaEducativaModel->update($inscripcion_id, 
                    [
                        'url' => $file_name
                    ]
                );
            }
        }

                   
        $oferta_action = $ofertaEducativaModel->update($inscripcion_id, 
            [
                'descripcion' => $descripcion,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Inscripción actualizada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function delete_inscripcion() {

        $ofertaEducativaModel = new OfertaEducativaInscripcionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        //$response = var_dump($this->request->getPost());
        
        $inscripcion_id = $this->request->getPost('inscripcion_id');
        $is_deleted = 1;
        
        $oferta_action = $ofertaEducativaModel->update($inscripcion_id, 
            [
                'is_deleted' => $is_deleted,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar eliminar el registro',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Inscripción eliminada con éxito.',
            );
        }
        
        
        return json_encode($response);
        
    }


    public function insert_inversion() {

        $ofertaEducativaModel = new OfertaEducativaInversionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $inversion = $this->request->getPost('inversion');


        $oferta_action = $ofertaEducativaModel->insert( 
            [
                'id_oferta_educativa' => $oferta_educativa_id,
                'inversion' => $inversion
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Inversión agregada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function update_inversion() {

        $ofertaEducativaModel = new OfertaEducativaInversionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $inversion_id = $this->request->getPost('inversion_id');
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $inversion = $this->request->getPost('inversion');

                   
        $oferta_action = $ofertaEducativaModel->update($inversion_id, 
            [
                'inversion' => $inversion,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Inversión actualizada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function delete_inversion() {

        $ofertaEducativaModel = new OfertaEducativaInversionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        //$response = var_dump($this->request->getPost());
        
        $inversion_id = $this->request->getPost('inversion_id');
        $is_deleted = 1;
        
        $oferta_action = $ofertaEducativaModel->update($inversion_id, 
            [
                'is_deleted' => $is_deleted,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar eliminar el registro',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Inversión eliminada con éxito.',
            );
        }
        
        
        return json_encode($response);
        
    }


    public function insert_plantel() {

        $ofertaEducativaModel = new OfertaEducativaPlantelModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $nombre = $this->request->getPost('nombre');


        $oferta_action = $ofertaEducativaModel->insert( 
            [
                'id_oferta_educativa' => $oferta_educativa_id,
                'nombre' => $nombre
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Título agregado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function update_plantel() {

        $ofertaEducativaModel = new OfertaEducativaPlantelModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');
        $plantel_id = $this->request->getPost('plantel_id');

        $nombre = $this->request->getPost('info');

                   
        $oferta_action = $ofertaEducativaModel->update($plantel_id, 
            [
                'nombre' => $nombre,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Título actualizado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function delete_plantel() {

        $ofertaEducativaModel = new OfertaEducativaPlantelModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $plantel_id = $this->request->getPost('id');
        $is_deleted = 1;

                   
        $oferta_action = $ofertaEducativaModel->update($plantel_id, 
            [
                'is_deleted' => $is_deleted,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar eliminar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Título eliminado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }



    public function insert_info_plantel() {

        $ofertaEducativaModel = new OfertaEducativaPlantelInfoModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');
        $plantel_id = $this->request->getPost('plantel_id');

        $info = $this->request->getPost('info');


        $oferta_action = $ofertaEducativaModel->insert( 
            [
                'id_oferta_educativa' => $oferta_educativa_id,
                'id_oferta_educativa_planteles' => $plantel_id,
                'info' => $info
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Descripción agregada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }

    public function update_info_plantel() {

        $ofertaEducativaModel = new OfertaEducativaPlantelInfoModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');
        $plantel_id = $this->request->getPost('plantel_id');
        $info_id = $this->request->getPost('info_id');

        $info = $this->request->getPost('info');

                   
        $oferta_action = $ofertaEducativaModel->update($info_id, 
            [
                'info' => $info,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Descripción actualizada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }

    public function delete_info_plantel() {

        $ofertaEducativaModel = new OfertaEducativaPlantelInfoModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $info_id = $this->request->getPost('id');
        $is_deleted = 1;

                   
        $oferta_action = $ofertaEducativaModel->update($info_id, 
            [
                'is_deleted' => $is_deleted,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar eliminar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Descripción eliminada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function insert_promocion() {

        $ofertaEducativaModel = new OfertaEducativaPromocionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $orden = $this->request->getPost('orden');

        // Archivo Inscripción
        if(isset($_FILES['archivo_promo']['name'])){
            $file_name = $_FILES['archivo_promo']['name'];
            $file_tmp = $this->request->getFile('archivo_promo');
            $file_tmp->move(ROOTPATH . 'public/assets/images/promo', $file_name);

            if($file_tmp->hasMoved()){ 
                $oferta_action = $ofertaEducativaModel->insert( 
                    [
                        'id_oferta_educativa' => $oferta_educativa_id,
                        'promociones' => $file_name,
                        'orden' => $orden,
                    ]
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'error',
                    'message_text' => 'Ocurrio un error al intentar agregar la información',
                );
    
            }
        }

        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Promoción agregada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function update_promocion() {

        $ofertaEducativaModel = new OfertaEducativaPromocionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $promocion_id = $this->request->getPost('promocion_id');
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $orden = $this->request->getPost('orden');

        // Archivo Inscripción
        if(isset($_FILES['archivo_promo']['name'])){
            $file_name = $_FILES['archivo_promo']['name'];
            $file_tmp = $this->request->getFile('archivo_promo');
            $file_tmp->move(ROOTPATH . 'public/assets/images/promo', $file_name);

            if($file_tmp->hasMoved()){ 
                $archivo_promocion_action = $ofertaEducativaModel->update($promocion_id, 
                    [
                        'promociones' => $file_name
                    ]
                );
            }
        }

                   
        $oferta_action = $ofertaEducativaModel->update($promocion_id, 
            [
                'orden' => $orden,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Promoción actualizada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function delete_promocion() {

        $ofertaEducativaModel = new OfertaEducativaPromocionModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        //$response = var_dump($this->request->getPost());
        
        $promocion_id = $this->request->getPost('promocion_id');
        $is_deleted = 1;
        
        $oferta_action = $ofertaEducativaModel->update($promocion_id, 
            [
                'is_deleted' => $is_deleted,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar eliminar el registro',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Promoción eliminada con éxito.',
            );
        }
        
        
        return json_encode($response);
        
    }

    public function insert_evento() {

        $ofertaEducativaModel = new OfertaEducativaEventosModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $orden = $this->request->getPost('orden');
        $titulo = $this->request->getPost('titulo');
        $fecha_inicio = $this->request->getPost('fecha_inicio');
        $fecha_fin = $this->request->getPost('fecha_fin');

        // Archivo Inscripción
        if(isset($_FILES['archivo_evento']['name'])){
            $file_name = $_FILES['archivo_evento']['name'];
            $file_tmp = $this->request->getFile('archivo_evento');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events_degree', $file_name);

            if($file_tmp->hasMoved()){ 
                $oferta_action = $ofertaEducativaModel->insert( 
                    [
                        'id_oferta_educativa' => $oferta_educativa_id,
                        'imagen' => $file_name,
                        'orden' => $orden,
                        'titulo' => $titulo,
                        'fecha_inicio' => $fecha_inicio,
                        'fecha_fin' => $fecha_fin,
                    ]
                );
            }else{
                $response = array(
                    'status' => 0,
                    'message' => 'error',
                    'message_text' => 'Ocurrio un error al intentar agregar la información',
                );
    
            }
        }

        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Promoción agregada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }

    public function update_evento() {

        $ofertaEducativaModel = new OfertaEducativaEventosModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $evento_id = $this->request->getPost('evento_id');
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $orden = $this->request->getPost('orden');
        $titulo = $this->request->getPost('titulo');
        $fecha_inicio = $this->request->getPost('fecha_inicio');
        $fecha_fin = $this->request->getPost('fecha_fin');

        // Archivo Inscripción
        if(isset($_FILES['archivo_evento']['name'])){
            $file_name = $_FILES['archivo_evento']['name'];
            $file_tmp = $this->request->getFile('archivo_evento');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events_degree', $file_name);

            if($file_tmp->hasMoved()){ 
                $archivo_evento_action = $ofertaEducativaModel->update($evento_id, 
                    [
                        'imagen' => $file_name
                    ]
                );
            }
        }

                   
        $oferta_action = $ofertaEducativaModel->update($evento_id, 
            [
                'orden' => $orden,
                'titulo' => $titulo,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Evento actualizado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }

    public function delete_evento() {

        $ofertaEducativaModel = new OfertaEducativaEventosModel();

        
        $evento_id = $this->request->getPost('evento_id');

        $evento_action = '';

        $evento_action = $ofertaEducativaModel->where('id', $evento_id)->delete();
        
        
        if ( !$evento_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar eliminar la información'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Evento eliminado con éxito.'
            );
        }
        
        return json_encode($response);
        
    }


    public function insert_instalacion() {

        $ofertaEducativaModel = new OfertaEducativaInstalacionesModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $texto = $this->request->getPost('texto');


        if($texto != '' && $oferta_educativa_id > 0){ 
            $oferta_action = $ofertaEducativaModel->insert( 
                [
                    'id_oferta_educativa' => $oferta_educativa_id,
                    'texto' => $texto
                ]
            );
        }else{
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );

        }

        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Texto de instalación agregado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }

    public function update_instalacion() {

        $ofertaEducativaModel = new OfertaEducativaInstalacionesModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        
        $instalacion_id = $this->request->getPost('instalacion_id');
        $oferta_educativa_id = $this->request->getPost('oferta_educativa_id');

        $texto = $this->request->getPost('texto');

                   
        $oferta_action = $ofertaEducativaModel->update($instalacion_id, 
            [
                'texto' => $texto
            ]
        );
        
        if ( !$oferta_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar actualizar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Instalación actualizada con éxito.',
            );
        }
        
        return json_encode($response);
        
    }

    public function delete_instalacion() {

        $ofertaEducativaModel = new OfertaEducativaInstalacionesModel();

        
        $instalacion_id = $this->request->getPost('instalacion_id');

        $evento_action = '';

        $evento_action = $ofertaEducativaModel->where('id', $instalacion_id)->delete();
        
        
        if ( !$evento_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar eliminar la información'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Instalación eliminada con éxito.'
            );
        }
        
        return json_encode($response);
        
    }


    public function list() {

        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $oferta_educativa = $ofertaEducativaModel->select('id, id_grado_academico, titulo, banner, banner_mobile, banner_posicion, video, descripcion, duracion, inicio_clases, url_plan_estudios, url_opciones_titulacion, url_rvoe, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id_grado_academico ASC','id ASC')
        ->findAll();

        
        if ( !$oferta_educativa ) {
            //return redirect()->back()->with('mensaje', 'Usuario y/o contraseña incorrectos.');
            $response = array(
                'status' => 0,
                'message' => 'No se encontraron registros en ese periodo'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'Success',
                'oferta_educativa' => $oferta_educativa
            );
        }
        

        return json_encode($response);
    }

    public function academic_degree() {
        
        $gradoAcademicoModel = new GradoAcademicoModel();

        
        $grado_academico = $gradoAcademicoModel->select('id, nombre, updated_at')
        ->where('is_deleted = ', 0)
        ->findAll();

        if ( !$grado_academico ) {
            //return redirect()->back()->with('mensaje', 'Usuario y/o contraseña incorrectos.');
            $response = array(
                'status' => 0,
                'message' => 'No se encontraron registros en ese periodo'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'Success',
                'grado_academico' => $grado_academico
            );
        }
        

        return json_encode($response);
    }

   
    public function list_degree() {
        //echo "id: ".$id;

        // Oferta Educativa
        $ofertaEducativaModel = new OfertaEducativaModel();
        
        $oferta_educativa = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, banner, banner_mobile, banner_posicion, video, descripcion, duracion, inicio_clases,, url_plan_estudios, url_opciones_titulacion, url_rvoe, video_activo, updated_at')
        ->where('is_deleted',0)
        ->orderBy('id ASC')
        ->findAll();

        // Inversión
        $inversionModel = new OfertaEducativaInversionModel();
        $array_inversion = [];

        // Inscripción
        $inscripcionModel = new OfertaEducativaInscripcionModel();
        
        // Planteles
        $plantelesModel = new OfertaEducativaPlantelModel();
        $array_info = [];

        // Planteles Info
        $plantelesInfoModel = new OfertaEducativaPlantelInfoModel();

        // Promociones
        $promocionesModel = new OfertaEducativaPromocionModel();
        $array_promociones = [];

        // Eventos
        $eventosModel = new OfertaEducativaEventosModel();


        $x = 1;
        $multiArray['bachillerato'] = [];
        $multiArray['licenciaturas'] = [];
        $multiArray['maestrias'] = [];
        $multiArray['doctorados'] = [];

        foreach($oferta_educativa as $oferta){        

            // Bachillerato
            if($oferta->id_grado_academico == 1){
                $grado_academico = 'bachillerato';

                // Inversión
                $inversion = $inversionModel->select('id, id_oferta_educativa, inversion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inversion as $inver){
                    array_push($array_inversion,$inver->inversion);
                }

                // Inscripción
                $inscripcion = $inscripcionModel->select('id, id_oferta_educativa, url, descripcion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inscripcion as $insc){
                    $array_inscripcion[] = array(
                        'url' => $insc->url,
                        'descripcion' => $insc->descripcion
                    );
                }

                // Planteles
                $planteles = $plantelesModel->select('id, id_oferta_educativa, nombre, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('id_oferta_educativa ASC','id ASC')
                ->findAll();
                

                $array_planteles = [];
                $array_info = [];
        
                foreach($planteles as $plantel){
        
                    $id_plantel = $plantel->id;
        
                    $planteles_info = $plantelesInfoModel->select('id, id_oferta_educativa, id_oferta_educativa_planteles, info, updated_at')
                    ->where('is_deleted = ', 0)
                    ->where('id_oferta_educativa',$oferta->id)
                    ->where('id_oferta_educativa_planteles', $id_plantel)
                    ->findAll();

                    //echo "<pre>",var_dump($planteles_info),"</pre>";

                    foreach($planteles_info as $plantel_info){
                        array_push($array_info,$plantel_info->info);   
                    }

                    //echo "<pre>",var_dump($array_info),"</pre>";
                    
                    $array_planteles[] = array(
                        'nombre' => $plantel->nombre,
                        'info' => $array_info,
                    );

                    $array_info = [];
                    
                }

                // Promociones
                $promociones = $promocionesModel->select('id, id_oferta_educativa, promociones, orden, is_deleted, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('orden ASC')
                ->findAll();

                foreach($promociones as $promo){
                    array_push($array_promociones,$promo->promociones);
                }

                // Eventos
                $array_eventos = [];
                $eventos = $eventosModel->select('id, id_oferta_educativa, imagen, titulo, fecha_inicio, fecha_fin, orden, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('fecha_fin >= date_add(NOW(), INTERVAL -1 DAY)')
                ->orderBy('orden ASC')        
                ->findAll();

                foreach($eventos as $evento){
                    $array_eventos[] = array(
                        'imagen' => $evento->imagen,
                        'titulo' => $evento->titulo,
                        'fecha_inicio' => $evento->fecha_inicio,
                        'fecha_fin' => $evento->fecha_fin,
                        'orden' => $evento->orden,
                    );
                }

                // Generamos la estructura del json para el bachillerato
                $multiArray['bachillerato'] += array(
                    $oferta->oferta_educativa => array(
                        'banner' => $oferta->banner,
                        'banner_mobile' => $oferta->banner_mobile,
                        'banner_posicion' => $oferta->banner_posicion,
                        'titulo' => $oferta->titulo,
                        'video' => $oferta->video,
                        'descripcion' => $oferta->descripcion,
                        'planteles' => $array_planteles,
                        'duracion' => $oferta->duracion,
                        'inversion' => $array_inversion,
                        'inicio_clases' => $oferta->inicio_clases,
                        'inscripcion' => $array_inscripcion,
                        'url_plan_estudios' => $oferta->url_plan_estudios,
                        'url_opciones_titulacion' => $oferta->url_opciones_titulacion,
                        'url_rvoe' => $oferta->url_rvoe,
                        'video_activo' => intval($oferta->video_activo),
                        'promociones' => $array_promociones,
                        'eventos' => $array_eventos,
                    )
                );

                $array_inversion = [];
                $array_inscripcion = [];
                $array_promociones = [];

            } // end if bachillerato



            // Licencituras
            if($oferta->id_grado_academico == 2){
                $grado_academico = 'licenciaturas';

                // Inversión
                $inversion = $inversionModel->select('id, id_oferta_educativa, inversion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inversion as $inver){
                    array_push($array_inversion,$inver->inversion);
                }

                // Inscripción
                $inscripcion = $inscripcionModel->select('id, id_oferta_educativa, url, descripcion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inscripcion as $insc){
                    $array_inscripcion[] = array(
                        'url' => $insc->url,
                        'descripcion' => $insc->descripcion
                    );
                }

                // Planteles
                $planteles = $plantelesModel->select('id, id_oferta_educativa, nombre, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('id_oferta_educativa ASC','id ASC')
                ->findAll();


                $array_planteles = [];
                $array_info = [];
        
                foreach($planteles as $plantel){
        
                    $id_plantel = $plantel->id;
        
                    $planteles_info = $plantelesInfoModel->select('id, id_oferta_educativa, id_oferta_educativa_planteles, info, updated_at')
                    ->where('is_deleted = ', 0)
                    ->where('id_oferta_educativa',$oferta->id)
                    ->where('id_oferta_educativa_planteles', $id_plantel)
                    ->findAll();

                    //echo "<pre>",var_dump($planteles_info),"</pre>";

                    foreach($planteles_info as $plantel_info){
                        array_push($array_info,$plantel_info->info);   
                    }

                    //echo "<pre>",var_dump($array_info),"</pre>";
                    
                    $array_planteles[] = array(
                        'nombre' => $plantel->nombre,
                        'info' => $array_info,
                    );

                    $array_info = [];
                    
                }
        
                // Promociones
                $promociones = $promocionesModel->select('id, id_oferta_educativa, promociones, orden, is_deleted, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('orden ASC')
                ->findAll();

                foreach($promociones as $promo){
                    array_push($array_promociones,$promo->promociones);
                }

                // Eventos
                $array_eventos = [];
                $eventos = $eventosModel->select('id, id_oferta_educativa, imagen, titulo, fecha_inicio, fecha_fin, orden, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('fecha_fin >= date_add(NOW(), INTERVAL -1 DAY)')
                ->orderBy('orden ASC')        
                ->findAll();

                foreach($eventos as $evento){
                    $array_eventos[] = array(
                        'imagen' => $evento->imagen,
                        'titulo' => $evento->titulo,
                        'fecha_inicio' => $evento->fecha_inicio,
                        'fecha_fin' => $evento->fecha_fin,
                        'orden' => $evento->orden,
                    );
                }

                // Generamos la estructura del json para licenciaturas
                $multiArray['licenciaturas'] += array(
                    $oferta->oferta_educativa => array(
                        'banner' => $oferta->banner,
                        'banner_mobile' => $oferta->banner_mobile,
                        'banner_posicion' => $oferta->banner_posicion,
                        'titulo' => $oferta->titulo,
                        'video' => $oferta->video,
                        'descripcion' => $oferta->descripcion,
                        'planteles' => $array_planteles,
                        'duracion' => $oferta->duracion,
                        'inversion' => $array_inversion,
                        'inicio_clases' => $oferta->inicio_clases,
                        'inscripcion' => $array_inscripcion,
                        'url_plan_estudios' => $oferta->url_plan_estudios,
                        'url_opciones_titulacion' => $oferta->url_opciones_titulacion,
                        'url_rvoe' => $oferta->url_rvoe,
                        'video_activo' => intval($oferta->video_activo),
                        'promociones' => $array_promociones,
                        'eventos' => $array_eventos,
                    )
                );

                $array_inversion = [];
                $array_inscripcion = [];
                $array_planteles = [];
                $array_promociones = [];
                
            } // end if licenciaturas



            // Maestrías
            if($oferta->id_grado_academico == 3){
                $grado_academico = 'maestrias';

                // Inversión
                $inversion = $inversionModel->select('id, id_oferta_educativa, inversion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inversion as $inver){
                    array_push($array_inversion,$inver->inversion);
                }

                // Inscripción
                $inscripcion = $inscripcionModel->select('id, id_oferta_educativa, url, descripcion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inscripcion as $insc){
                    $array_inscripcion[] = array(
                        'url' => $insc->url,
                        'descripcion' => $insc->descripcion
                    );
                }

                // Planteles
                $planteles = $plantelesModel->select('id, id_oferta_educativa, nombre, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('id_oferta_educativa ASC','id ASC')
                ->findAll();
        

                $array_planteles = [];
                $array_info = [];
        
                foreach($planteles as $plantel){
        
                    $id_plantel = $plantel->id;
        
                    $planteles_info = $plantelesInfoModel->select('id, id_oferta_educativa, id_oferta_educativa_planteles, info, updated_at')
                    ->where('is_deleted = ', 0)
                    ->where('id_oferta_educativa',$oferta->id)
                    ->where('id_oferta_educativa_planteles', $id_plantel)
                    ->findAll();

                    //echo "<pre>",var_dump($planteles_info),"</pre>";

                    foreach($planteles_info as $plantel_info){
                        array_push($array_info,$plantel_info->info);   
                    }

                    //echo "<pre>",var_dump($array_info),"</pre>";
                    
                    $array_planteles[] = array(
                        'nombre' => $plantel->nombre,
                        'info' => $array_info,
                    );

                    $array_info = [];
                    
                }

                // Promociones
                $promociones = $promocionesModel->select('id, id_oferta_educativa, promociones, orden, is_deleted, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('orden ASC')
                ->findAll();

                foreach($promociones as $promo){
                    array_push($array_promociones,$promo->promociones);
                }

                // Eventos
                $array_eventos = [];
                $eventos = $eventosModel->select('id, id_oferta_educativa, imagen, titulo, fecha_inicio, fecha_fin, orden, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('fecha_fin >= date_add(NOW(), INTERVAL -1 DAY)')
                ->orderBy('orden ASC')        
                ->findAll();

                foreach($eventos as $evento){
                    $array_eventos[] = array(
                        'imagen' => $evento->imagen,
                        'titulo' => $evento->titulo,
                        'fecha_inicio' => $evento->fecha_inicio,
                        'fecha_fin' => $evento->fecha_fin,
                        'orden' => $evento->orden,
                    );
                }

                // Generamos la estructura del json para las maestrias
                $multiArray['maestrias'] += array(
                    $oferta->oferta_educativa => array(
                        'banner' => $oferta->banner,
                        'banner_mobile' => $oferta->banner_mobile,
                        'banner_posicion' => $oferta->banner_posicion,
                        'titulo' => $oferta->titulo,
                        'video' => $oferta->video,
                        'descripcion' => $oferta->descripcion,
                        'planteles' => $array_planteles,
                        'duracion' => $oferta->duracion,
                        'inversion' => $array_inversion,
                        'inicio_clases' => $oferta->inicio_clases,
                        'inscripcion' => $array_inscripcion,
                        'url_plan_estudios' => $oferta->url_plan_estudios,
                        'url_opciones_titulacion' => $oferta->url_opciones_titulacion,
                        'url_rvoe' => $oferta->url_rvoe,
                        'video_activo' => intval($oferta->video_activo),
                        'promociones' => $array_promociones,
                        'eventos' => $array_eventos,
                    )
                );

                $array_inversion = [];
                $array_inscripcion = [];
                $array_promociones = [];

            } // end if maestrías



            //echo "id_grado_academico: ".$oferta->id_grado_academico."<br>";
            // Doctorados
            if($oferta->id_grado_academico == 4){
                $grado_academico = 'doctorados';

                // Inversión
                $inversion = $inversionModel->select('id, id_oferta_educativa, inversion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inversion as $inver){
                    array_push($array_inversion,$inver->inversion);
                }

                // Inscripción
                $inscripcion = $inscripcionModel->select('id, id_oferta_educativa, url, descripcion, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->findAll();

                foreach($inscripcion as $insc){
                    $array_inscripcion[] = array(
                        'url' => $insc->url,
                        'descripcion' => $insc->descripcion
                    );
                }

                // Planteles
                //echo "oferta_ id: ".$oferta->id."<br>";
                $planteles = $plantelesModel->select('id, id_oferta_educativa, nombre, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('id ASC')
                ->findAll();

                //echo "<pre>",var_dump($planteles),"</pre>";

                $array_planteles = [];
                $array_info = [];
        
                foreach($planteles as $plantel){
                    //echo "<pre>",var_dump($plantel),'</pre>';
        
                    $id_plantel = $plantel->id;
                    //echo "id_plantel id: ".$id_plantel."<br>";
        
                    $planteles_info = $plantelesInfoModel->select('id, id_oferta_educativa, id_oferta_educativa_planteles, info, updated_at')
                    ->where('is_deleted = ', 0)
                    ->where('id_oferta_educativa',$oferta->id)
                    ->where('id_oferta_educativa_planteles', $id_plantel)
                    ->findAll();

                    //echo "<pre>",var_dump($planteles_info),"</pre>";

                    foreach($planteles_info as $plantel_info){
                        array_push($array_info,$plantel_info->info);   
                    }

                    //echo "<pre>",var_dump($array_info),"</pre>";
                    
                    $array_planteles[] = array(
                        'nombre' => $plantel->nombre,
                        'info' => $array_info,
                    );

                    $array_info = [];
                    
                }

                // Promociones
                $promociones = $promocionesModel->select('id, id_oferta_educativa, promociones, orden, is_deleted, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('is_deleted',0)
                ->orderBy('orden ASC')
                ->findAll();

                foreach($promociones as $promo){
                    array_push($array_promociones,$promo->promociones);
                }

                // Eventos
                $array_eventos = [];
                $eventos = $eventosModel->select('id, id_oferta_educativa, imagen, titulo, fecha_inicio, fecha_fin, orden, updated_at')
                ->where('id_oferta_educativa',$oferta->id)
                ->where('fecha_fin >= date_add(NOW(), INTERVAL -1 DAY)')
                ->orderBy('orden ASC')        
                ->findAll();

                foreach($eventos as $evento){
                    $array_eventos[] = array(
                        'imagen' => $evento->imagen,
                        'titulo' => $evento->titulo,
                        'fecha_inicio' => $evento->fecha_inicio,
                        'fecha_fin' => $evento->fecha_fin,
                        'orden' => $evento->orden,
                    );
                }

                // Generamos la estructura del json para el doctorado
                $multiArray['doctorados'] += array(
                    $oferta->oferta_educativa => array(
                        'banner' => $oferta->banner,
                        'banner_mobile' => $oferta->banner_mobile,
                        'banner_posicion' => $oferta->banner_posicion,
                        'titulo' => $oferta->titulo,
                        'video' => $oferta->video,
                        'descripcion' => $oferta->descripcion,
                        'planteles' => $array_planteles,
                        'duracion' => $oferta->duracion,
                        'inversion' => $array_inversion,
                        'inicio_clases' => $oferta->inicio_clases,
                        'inscripcion' => $array_inscripcion,
                        'url_plan_estudios' => $oferta->url_plan_estudios,
                        'url_opciones_titulacion' => $oferta->url_opciones_titulacion,
                        'url_rvoe' => $oferta->url_rvoe,
                        'video_activo' => intval($oferta->video_activo),
                        'promociones' => $array_promociones,
                        'eventos' => $array_eventos,
                    )
                );

                $array_inversion = [];
                $array_inscripcion = [];
                $array_promociones = [];

            } // end if doctorados


        } // end foreach

        // Convert the multidimensional array to JSON
        $jsonString = $multiArray;

        return json_encode($jsonString);

    }

    function eliminar_acentos($cadena){
		
		//Reemplazamos la A y a
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );

		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );

		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );

		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$cadena
		);
		
		return $cadena;
	}

}