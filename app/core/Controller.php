<?php
declare(strict_types=1);
class Controller
{
    protected function baseUrl(): string
    {
        $script = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
        $folder = str_replace('\\', '/', dirname($script));
        return rtrim($folder, '/');
    }
    protected function e(mixed $val): string
    {
        return htmlspecialchars((string) ($val ?? ''), ENT_QUOTES, 'UTF-8');
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