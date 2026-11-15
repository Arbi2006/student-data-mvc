<?php
declare(strict_types=1);
class Model
{
    protected PDO $db;
    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        $dsn = 'mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];

        $this->db = new PDO($dsn, $config['user'], $config['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}