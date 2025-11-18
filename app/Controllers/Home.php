<?php

namespace App\Controllers;

use App\Models\ContadorModel;
use App\Models\ProspectoModel;
use App\Models\EventosModel;
use App\Models\OfertaEducativaModel;

class Home extends BaseController
{
    public function index()
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
        echo view('home/banner-slides');
        echo view('home/default');
        echo view('templates/footer');
        // echo view('scripts/scripts');
        echo view('templates/close');
    }

    public function contacto()
    {

        // Contador de Visitas
        $contadorModel = new ContadorModel();
        $visitas = $contadorModel->findColumn('visitas');

        // Oferta Educativa para el menú
        $ofertaEducativaModel = new OfertaEducativaModel();

        $menu_oferta = $ofertaEducativaModel->select('id, id_grado_academico, oferta_educativa, titulo, titulo_menu, is_deleted, updated_at')
            ->where('is_deleted', 0)
            ->orderBy('id_grado_academico ASC', 'id ASC')
            ->findAll();


        $data_breadcrumb = array(
            'title' => 'Contacto'
        );

        $data_footer = array(
            'grade' => '',
            'menu' => 'contacto',
            'visitas' => $visitas,
            'menu_oferta' => $menu_oferta,
        );

        echo view('templates/header');
        echo view('templates/nav-top', $data_footer);
        echo view('templates/sidebar-right');
        echo view('contact/banner', $data_breadcrumb);
        echo view('contact/contacto');
        echo view('templates/footer', $data_footer);
        echo view('scripts/scripts');
        echo view('templates/close');
    }

    public function enviar_contacto()
    {

        // Obtenemos los inputs
        $nombre_form = $this->request->getPost('nombre');
        $apellidos_form = $this->request->getPost('apellidos');
        $correo_form = $this->request->getPost('correo');
        $telefono_form = $this->request->getPost('telefono');
        $asunto_form = $this->request->getPost('asunto');
        $mensaje_form = $this->request->getPost('mensaje');

        // Validamos el Recaptcha
        define("RECAPTCHA_V3_SECRET_KEY_CONTACT", '6LfCs6YpAAAAANbZvFUzDgjpbyarIH5_tG-leYKZ');
        $token = $this->request->getPost('token');
        $action = 'validate_captcha';

        // Mandamos la petición por CURL para validar el reCaptcha
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY_CONTACT, 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);

        // Verificamos la respuesta del reCaptcha
        if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
            // reCaptcha Valido

            $email = 'informes@impo.org.mx'; // Cuenta que recibe los correos

            // Estatus Pedido Pagado
            $asunto = utf8_decode("$asunto_form - Sitio IMPo");
            $body = "<span style=\"font-weight: bold;\">Información recibida:</span><br><br>";
            $body .= "<span style=\"font-weight: bold;\">Nombre:</span> $nombre_form <br><br>";
            $body .= "<span style=\"font-weight: bold;\">Apellido(s):</span> $apellidos_form <br><br>";
            $body .= "<span style=\"font-weight: bold;\">Correo:</span> $correo_form <br><br>";
            $body .= "<span style=\"font-weight: bold;\">Teléfono:</span> $telefono_form <br><br>";
            $body .= "<span style=\"font-weight: bold;\">Asunto:</span> $asunto_form <br><br>";
            $body .= "<span style=\"font-weight: bold;\">Mensaje:</span><br><br>";
            $body .= "$mensaje_form <br><br>";
            $body .= "Enviado desde impo.org.mx<br>";

            $from = "informes@impo.org.mx"; // Cuenta que envía los correos
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
            $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            if (!mail($email, $asunto, utf8_decode($body), $headers)) {
                $response = array(
                    'status' => 0,
                    'message' => 'error',
                    'message_notify' => "Falló el envío de correo.",
                );
            } else {
                $response = array(
                    'status' => 1,
                    'message' => 'success',
                    'message_notify' => "Envío de correo exitoso.",
                );
            }
        } else {
            // reCaptcha Error
            // Respuesta
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_notify' => "Error al validar el Captcha",
            );
        }

        // Regresamos la respuesta
        return $this->response->setJSON($response);
    }

    public function contador_visitas()
    {

        // Obtenemos los inputs
        $visitas_form = $this->request->getPost('visitas');

        // Verificamos que exista el contador de visitas
        if (isset($visitas_form) && $visitas_form == '1') {

            // Almacenamos la información en la base de datos
            $contadorModel = new ContadorModel();
            $visitas = $contadorModel->findColumn('visitas');

            $contador_visitas = $visitas[0] + 1;

            $dataModel = [
                'visitas' => $contador_visitas,
            ];

            $contadorModel->update(1, $dataModel);

            $response = array(
                'status' => 1,
                'message' => 'success',
                'message_notify' => "Actualizando contador de visitas.",
            );
        } else {
            // Respuesta
            $response = array(
                'status' => 0,
                'message' => 'error',
                'message_notify' => "No se obtuvo el contador de visitas",
            );
        }

        // Regresamos la respuesta
        return $this->response->setJSON($response);
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
        echo view('admin/templates/nav-top',$data_session);
        echo view('admin/templates/nav-aside');
        echo view('admin/templates/breadcrumb',$data_breadcrumb);
        echo view('admin/home/default',$data_main);
        echo view('admin/templates/footer',$data_footer);
    }
}
