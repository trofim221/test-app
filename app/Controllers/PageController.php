<?php
namespace App\Controllers;

use App\Core\View;
use App\Core\Controllers;
use App\Services\UserActivityService;

class PageController extends Controllers
{
    private UserActivityService $activityService;

    public function __construct(UserActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function pageA()
    {
        $this->activityService->log('view-page', 'page-a');
        View::render('page/page-a');
    }

    public function buyCow()
    {
        $this->activityService->log('button-click', 'buy-cow');
        $this->redirect('/page-a?bought=1');
    }

    public function pageB()
    {
        $this->activityService->log('view-page', 'page-b');
        View::render('page/page-b');
    }

    public function download(string $file = 'Setup.exe', string $dir = '/public/downloads/')
    {
        $this->activityService->log('button-click', 'download');

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