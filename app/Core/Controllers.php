<?php

namespace App\Core;

class Controllers
{
    protected function redirect(string $path): void
    {
        header("Location: $path");
        exit;
    }

}