<?php

namespace App\Controllers;
use App\Models\GaleriaModel;

class Home extends BaseController
{
    public function index()
    {

        $data = array(
            'Titulo' => "Home",
            'Descripcion' => ""
        );

        $data_nav = ['menu_activo' => 'inicio'];
        echo view('templates/header');
        echo view('templates/nav-top', $data_nav);
        echo view('home/banner-slides');
        echo view('home/default',$data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    public function acerca_de()
    {

        $data = array(
            'Titulo' => "Acerca de",
            'Descripcion' => ""
        );

        $data_nav = ['menu_activo' => 'nosotros'];
        echo view('templates/header');
        echo view('templates/nav-top', $data_nav);
        echo view('aboutus/default', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    public function galeria()
    {

        $galeriaModel = new GaleriaModel();

        $data = array(
            'Titulo' => "Galeria",
            'Descripcion' => "",
            'Galeria' => $galeriaModel->obtiene_galeria()
        );

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('gallery/default', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    public function faqs()
    {

        $data = array(
            'Titulo' => "Faqs",
            'Descripcion' => ""
        );

        $data_nav = ['menu_activo' => 'faqs'];
        echo view('templates/header');
        echo view('templates/nav-top', $data_nav);
        echo view('faqs/default', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    public function contacto()
    {

        $data = array(
            'Titulo' => "Contacto",
            'Descripcion' => ""
        );

        $data_nav = ['menu_activo' => 'contacto'];
        echo view('templates/header');
        echo view('templates/nav-top', $data_nav);
        echo view('contact/default', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    public function iniciar_sesion()
    {

        $data = array(
            'Titulo' => "Inicio de Sesión",
            'Descripcion' => "",
        );

        echo view('templates/header');
        echo view('templates/nav-top');
        echo view('users/default', $data);
        echo view('templates/footer');
        echo view('templates/close');
    }

    

    public function admin()
    {
        $session = session();

        // Si ya inició sesión como admin, NO mostrar login otra vez
        if ($session->has('User_ID') && $session->Rol == 1) {
            return redirect()->to(ADMIN_HOME . 'panel/home');
        }

        echo view('admin/templates/index');
    }

    public function dashboard()
    {
        $session = session();

        $data_breadcrumb = array(
            'title' => 'Dashboard',
            'icon' => '<i class="fas fa-tachometer-alt"></i>'
        );

        $data_main = array(
            'menu' => 'dashboard',
        );

        $data_session = array(
            'session' => $session
        );

        $data_footer = array(
            'menu' => 'dashboard',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/home/default', $data_main);
        echo view('admin/templates/footer', $data_footer);
    }
}
