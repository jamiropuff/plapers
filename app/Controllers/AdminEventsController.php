<?php

namespace App\Controllers;

use App\Models\EventosModel;

class AdminEventsController extends BaseController
{

    public function events() {
        
        $data_breadcrumb = array(
            'title' => 'Eventos',
            'icon' => '<i class="far fa-calendar-alt"></i>'
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_breadcrumb);
        echo view('admin/templates/nav-aside',$data_breadcrumb);
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/events/default');
        echo view('admin/templates/footer',$data_breadcrumb);
    }
   
    public function list() {

        $eventosModel = new EventosModel();
        
        $eventos = $eventosModel->select('id, imagen, titulo, fecha_inicio, fecha_fin, archivo_presencial, archivo_zoom, updated_at')
        ->where('is_deleted',0)
        ->orderBy('fecha_inicio ASC')
        ->findAll();

        
        if ( !$eventos ) {
            //return redirect()->back()->with('mensaje', 'Usuario y/o contraseña incorrectos.');
            $response = array(
                'status' => 0,
                'message' => 'No se encontraron registros'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'Success',
                'eventos' => $eventos
            );
        }
        

        return json_encode($response);
    }

    public function add() {

        $eventosModel = new EventosModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        //echo "<pre>", var_dump($this->request->getFiles()), "</pre>";

        // Obtenemos el siguiente orden
        $maxOrden = $eventosModel->selectMax('orden')->get()->getRow();
        $newOrden = $maxOrden->orden;
        $orden = intval($newOrden)+1;

                
        $titulo = $this->request->getPost('titulo');
        $fecha_inicio = $this->request->getPost('fecha_inicio');
        $fecha_fin = $this->request->getPost('fecha_fin');

        $evento_action = '';

        $evento_action = $eventosModel->insert( 
            [
                'titulo' => $titulo,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'orden' => $orden
            ]
        );

        // ID Insertado
        $insert_id = $eventosModel->getInsertID();
        
        // Imagen
        if(isset($_FILES['imagen']['name'])){
            $file_name = $_FILES['imagen']['name'];
            $file_tmp = $this->request->getFile('imagen');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events', $file_name);

            if($file_tmp->hasMoved()){ 
                $evento_action = $eventosModel->update($insert_id, 
                    [
                        'imagen' => $file_name
                    ]
                );
            }
        }

        // Archivo Presencial
        if(isset($_FILES['archivo_presencial']['name'])){
            $file_name = $_FILES['archivo_presencial']['name'];
            $file_tmp = $this->request->getFile('archivo_presencial');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events', $file_name);

            if($file_tmp->hasMoved()){ 
                $evento_action = $eventosModel->update($insert_id, 
                    [
                        'archivo_presencial' => $file_name
                    ]
                );
            }
        }

        // Archivo Zoom
        if(isset($_FILES['archivo_zoom']['name'])){
            $file_name = $_FILES['archivo_zoom']['name'];
            $file_tmp = $this->request->getFile('archivo_zoom');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events', $file_name);

            if($file_tmp->hasMoved()){ 
                $evento_action = $eventosModel->update($insert_id, 
                    [
                        'archivo_zoom' => $file_name
                    ]
                );
            }
        }        
        
        if ( !$evento_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información',
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Evento agregado con éxito.',
            );
        }
        
        return json_encode($response);
        
    }


    public function upd() {

        $eventosModel = new EventosModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        //echo "<pre>", var_dump($this->request->getFiles()), "</pre>";
        
        $evento_id = $this->request->getPost('evento_id');
        $titulo = $this->request->getPost('titulo');
        $fecha_inicio = $this->request->getPost('fecha_inicio');
        $fecha_fin = $this->request->getPost('fecha_fin');

        $evento_action = '';

        $evento_action = $eventosModel->update( $evento_id, 
            [
                'titulo' => $titulo,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
            ]
        );
        
        // Imagen
        if(isset($_FILES['imagen']['name'])){
            $file_name = $_FILES['imagen']['name'];
            $file_tmp = $this->request->getFile('imagen');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events', $file_name);

            if($file_tmp->hasMoved()){ 
                $evento_action = $eventosModel->update($evento_id, 
                    [
                        'imagen' => $file_name
                    ]
                );
            }
        }

        // Archivo Presencial
        if(isset($_FILES['archivo_presencial']['name'])){
            $file_name = $_FILES['archivo_presencial']['name'];
            $file_tmp = $this->request->getFile('archivo_presencial');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events', $file_name);

            if($file_tmp->hasMoved()){ 
                $evento_action = $eventosModel->update($evento_id, 
                    [
                        'archivo_presencial' => $file_name
                    ]
                );
            }
        }

        // Archivo Zoom
        if(isset($_FILES['archivo_zoom']['name'])){
            $file_name = $_FILES['archivo_zoom']['name'];
            $file_tmp = $this->request->getFile('archivo_zoom');
            $file_tmp->move(ROOTPATH . 'public/assets/images/events', $file_name);

            if($file_tmp->hasMoved()){ 
                $evento_action = $eventosModel->update($evento_id, 
                    [
                        'archivo_zoom' => $file_name
                    ]
                );
            }
        }
        
        if ( !$evento_action ) {
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_text' => 'Ocurrio un error al intentar agregar la información'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_text' => 'Evento actualizado con éxito.'
            );
        }
        
        return json_encode($response);
        
    }

    public function del() {

        $eventosModel = new EventosModel();

        //echo "<pre>", var_dump($this->request->getPost()), "</pre>";
        //echo "<pre>", var_dump($this->request->getFiles()), "</pre>";
        
        $evento_id = $this->request->getPost('evento_id');

        $evento_action = '';

        $evento_action = $eventosModel->where('id', $evento_id)->delete();
        
        
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