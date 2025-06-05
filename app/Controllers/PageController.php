<?php
namespace App\Controllers;

use App\Core\View;
use App\Core\Controllers;

class PageController extends Controllers
{

    public function pageA()
    {
        View::render('page/page-a');
    }

    public function buyCow()
    {
        $this->redirect('/page-a?bought=1');
    }

    public function pageB()
    {
        View::render('page/page-b');
    }

    public function download(string $file = 'Setup.exe', string $dir = '/public/downloads/')
    {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . $dir . $file;

        if (!$this->fileExists($filePath)) {
            return;
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=\"$file\"");
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }

    private function fileExists(string $filePath): bool
    {
        if (!file_exists($filePath)) {
            http_response_code(404);
            echo 'File not found.';
            // to do: Log for file not found
            return false;
        }
        return true;
    }

}