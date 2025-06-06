<?php
declare(strict_types=1);

namespace App\Services;

class FileDownloader
{
    public function download(string $file = '', string $dir = ''): void
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
            return false;
        }
        return true;
    }
}