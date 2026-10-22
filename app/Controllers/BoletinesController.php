<?php

namespace App\Controllers;

use App\Models\BoletinModel;

class BoletinesController extends BaseController
{
    protected $auth = false;

    public function registro()
    {
        if (!$this->request->is('post')) {
            return redirect()->to(base_url());
        }

        $email = trim((string) $this->request->getPost('Email'));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            session()->setFlashdata('newsletter_message', [
                'type' => 'danger',
                'text' => 'Ingresa un correo electrónico válido.'
            ]);
            return redirect()->to(base_url());
        }

        $response = (new BoletinModel())->registra_correo($email);
        $isSuccess = ($response['Code'] ?? null) === REQUEST_SUCCESS;
        session()->setFlashdata('newsletter_message', [
            'type' => $isSuccess ? 'success' : 'warning',
            'text' => $isSuccess ? 'Tu correo quedó registrado en el boletín.' : ($response['Msg'] ?? 'No se pudo registrar el correo.')
        ]);

        return redirect()->to(base_url());
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
