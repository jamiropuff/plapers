<?php

namespace App\Controllers;

use App\Models\CatalogosModel;

class Catalogos extends BaseController
{

    protected $catalogosModel;

    public function __construct()
    {
        $this->catalogosModel = new CatalogosModel();
    }

    public function catalogos()
    {
        $method = $this->request->getMethod(true);
        if ($method === 'GET') {
            $response = $this->catalogosModel->catalogos();
        } else {
            $response['Code'] = METHOD_NOT_ALLOWED;
            $response['Msg'] = MSG_METHOD_NOT_ALLOWED;
        }
        return $this->response->setJSON($response);
    }

}
