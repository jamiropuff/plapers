<?php

namespace App\Controllers;
use App\Models\ProductoModel;

class Placas extends BaseController
{
    public function tienda()
    {

        // $data_footer = array(
        //     'grade' => '',
        //     'menu' => 'inicio',
        //     'visitas' => $visitas,
        //     'eventos' => $eventos,
        //     'menu_oferta' => $menu_oferta
        // );

        echo view('templates/header');
        echo view('templates/nav-top');
        // echo view('templates/sidebar-right');
        //echo view('templates/breadcrumb',$data_breadcrumb);
        echo view('store/default');
        echo view('templates/footer');
        // echo view('scripts/scripts');
        echo view('templates/close');
    }

    public function americana()
    {

        $productoModel = new ProductoModel();

        $data = array(
            'Titulo' => "Placa Americana",
            'Descripcion' => "Placas en formato Americano (15 x 30 cms.) con diferentes materiales, acabados, diseños y con elección a que la personalices.",
            'Placas' => $productoModel->lista(1, 2)

        );

        echo view('templates/header');
        echo view('templates/nav-top');
        // echo view('templates/sidebar-right');
        //echo view('templates/breadcrumb',$data_breadcrumb);
        echo view('store/default', $data);
        echo view('templates/footer');
        // echo view('scripts/scripts');
        echo view('templates/close');
    }

    public function europea()
    {

        $productoModel = new ProductoModel();

        $data = array(
            'Titulo' => "Placa Europea",
            'Descripcion' => "Placas en formato Europeo (11 X 52 CMS.) con diferentes acabados, diseños y con elección a que la personalices.",
            'Placas' => $productoModel->lista(1, 4)

        );

        echo view('templates/header');
        echo view('templates/nav-top');
        // echo view('templates/sidebar-right');
        //echo view('templates/breadcrumb',$data_breadcrumb);
        echo view('store/default', $data);
        echo view('templates/footer');
        // echo view('scripts/scripts');
        echo view('templates/close');
    }

    public function euromini()
    {
        $productoModel = new ProductoModel();

        $data = array(
            'Titulo' => "Placa Euromini",
            'Descripcion' => "Placas en formato Euromini (7 x 46 cms.) con diferentes materiales, acabados, diseños y con elección a que la personalices.",
            'Placas' => $productoModel->lista(1, 3)

        );

        echo view('templates/header');
        echo view('templates/nav-top');
        // echo view('templates/sidebar-right');
        //echo view('templates/breadcrumb',$data_breadcrumb);
        echo view('store/default', $data);
        echo view('templates/footer');
        // echo view('scripts/scripts');
        echo view('templates/close');
    }

    public function bicicleta()
    {

        $productoModel = new ProductoModel();

        $data = array(
            'Titulo' => "Placa Bicicleta",
            'Descripcion' => "Placas en formato Bicicleta (8 X 14 CMS.) con diferentes acabados, diseños y con elección a que la personalices.",
            'Placas' => $productoModel->lista(1, 1)

        );

        echo view('templates/header');
        echo view('templates/nav-top');
        // echo view('templates/sidebar-right');
        //echo view('templates/breadcrumb',$data_breadcrumb);
        echo view('store/default', $data);
        echo view('templates/footer');
        // echo view('scripts/scripts');
        echo view('templates/close');
    }

    public function accesorios()
    {

        // $data_footer = array(
        //     'grade' => '',
        //     'menu' => 'inicio',
        //     'visitas' => $visitas,
        //     'eventos' => $eventos,
        //     'menu_oferta' => $menu_oferta
        // );

        echo view('templates/header');
        echo view('templates/nav-top');
        // echo view('templates/sidebar-right');
        //echo view('templates/breadcrumb',$data_breadcrumb);
        echo view('store/accesorios');
        echo view('templates/footer');
        // echo view('scripts/scripts');
        echo view('templates/close');
    }
}
