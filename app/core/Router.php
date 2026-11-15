<?php
declare(strict_types=1);
class Router
{
    private array $routes = [
        'GET'=> [],
        'POST'=> [],
    ];
    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$this->bersihinPath($path)] = $handler;
    }
    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$this->bersihinPath($path)] = $handler;
    }
    private function bersihinPath(string $path): string
    {
        $p = '/' . trim($path, '/');
        return $p === '//' ? '/' : $p;
    }
    private function getUri(): string
    {
        $raw = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $uri = is_string($raw) ? rawurldecode($raw) : '/';
        $script = rawurldecode((string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php'));
        $base = rtrim(str_replace('\\', '/', dirname($script)), '/');
        if ($base !== '' && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }
        if (str_starts_with($uri, '/index.php')) {
            $uri = substr($uri, strlen('/index.php'));
        }
        return $this->bersihinPath($uri === '' ? '/' : $uri);
    }
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $this->getUri();
        $handler = $this->routes[$method][$uri] ?? null;
        if ($handler === null) {
            http_response_code(404);
            echo '404 - Halaman ga ketemu: ' . htmlspecialchars($uri, ENT_QUOTES, 'UTF-8');
            return;
        }
        [$class, $methodName] = $handler;
        $obj = new $class();
        $obj->$methodName();
    }
}
