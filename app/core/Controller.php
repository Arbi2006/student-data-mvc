<?php

declare(strict_types=1);

class Controller
{
    protected function baseUrl(): string
    {
        $script = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
        $dir = str_replace('\\', '/', dirname($script));
        $dir = rtrim($dir, '/');
        return $dir;
    }

    protected function view(string $view, array $data = []): void
    {
        $baseUrl = $this->baseUrl();
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $this->baseUrl() . '/' . ltrim($path, '/'));
        exit;
    }
}