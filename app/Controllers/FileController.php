<?php 

namespace App\Controllers;

class FileController extends BaseController
{
    public function serveFile($folder, $filename)
    {
        $basePath = ROOTPATH . 'uploads/' . $folder . '/';
        $filePath = $basePath . $filename;
        
        // Verificar que el archivo existe y es seguro
        if (!file_exists($filePath) || !is_file($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        // Obtener el tipo MIME
        $mime = mime_content_type($filePath);
        if (!$mime) {
            $mime = 'application/octet-stream';
        }
        
        // Enviar headers y el archivo
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}