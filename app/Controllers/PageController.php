<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Core\Controllers;
use App\Services\FileDownloader;

class PageController extends Controllers
{
    private FileDownloader $downloader;

    public function __construct(FileDownloader $downloader)
    {
        $this->downloader = $downloader;
    }

    public function pageA(): void
    {
        View::render('page/page-a');
    }

    public function buyCow(): void
    {
        $this->redirect('/page-a?bought=1');
    }

    public function pageB(): void
    {
        View::render('page/page-b');
    }

    public function download(): void
    {
        $this->downloader->download('Setup.exe', '/downloads/');
    }
}