<?php

namespace App\Controllers;

use App\Models\ProspectoModel;

class ProspectiveController extends BaseController
{

    public function prospectives() {
        
        $data_breadcrumb = array(
            'title' => 'Prospectos de Formularios',
            'icon' => '<i class="fas fa-users"></i>'
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top',$data_breadcrumb);
        echo view('admin/templates/nav-aside',$data_breadcrumb);
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/prospectives/default');
        echo view('admin/templates/footer',$data_breadcrumb);
    }

    public function search() {
        //echo "searching...";

        $fecha_inicio = $this->request->getPost('fecha_inicio');
        $fecha_fin = $this->request->getPost('fecha_fin');

        $prospectoModel = new ProspectoModel();

        
        $prospectos = $prospectoModel->select('id, nombres, apellidos, email, telefono, plantel, interes, medio_entero, mensaje, fecha_upd')
        ->where('fecha_upd >=', $fecha_inicio)
        ->where('fecha_upd <=', $fecha_fin)
        ->findAll();

        
        if ( !$prospectos ) {
            //return redirect()->back()->with('mensaje', 'Usuario y/o contraseña incorrectos.');
            $response = array(
                'status' => 0,
                'message' => 'No se encontraron registros en ese periodo'
            );
        }else{

            $response = array(
                'status' => 1,
                'message' => 'Success',
                'prospectos' => $prospectos
            );
        }

        return json_encode($response);
    }

}