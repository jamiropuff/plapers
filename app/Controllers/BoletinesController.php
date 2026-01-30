<?php

namespace App\Controllers;

use App\Models\BoletinModel;

class BoletinesController extends BaseController
{
    protected $auth = false;

    public function registro()
    {
        if ($this->request->getMethod() === 'post') {

            $email = $this->request->getPost('Email');

            $boletinesModel = new BoletinesModel();
            $response = $boletinesModel->registra_correo($email);

            $response['Titulo'] = 'Suscritos al boletín';

            return view('boletin/respuesta', $response);

        } else {
            return redirect()->to('/');
        }
    }

    public function lista_suscritos()
    {
        $boletinesModel = new BoletinModel();
        $suscritos = $boletinesModel->lista_suscritos();

        $data_breadcrumb = array(
            'title' => 'Suscritos al boletín',
            'icon' => '<i class="fa-solid fa-envelope-open-text"></i>'
        );

        $data_main = array(
            'menu' => 'boletin',
            'Titulo' => 'Suscritos al boletín',
            'Suscritos' => $suscritos,
        );

        $session = session();
        $data_session = array(
            "session" => $session
        );

        $data_footer = array(
            'menu' => 'boletin',
        );

        echo view('admin/templates/header');
        echo view('admin/templates/nav-top', $data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb', $data_breadcrumb);
        echo view('admin/boletin/suscritos', $data_main);
        echo view('admin/templates/footer', $data_footer);
        echo view('admin/templates/end', $data_footer);
    }
}
