<?php

declare(strict_types=1);

class Model
{
    protected PDO $db;

    public function __construct()
    {
        $cfg = require __DIR__ . '/../../config/database.php';
        $dsn = 'mysql:host=' . $cfg['host'] . ';port=' . $cfg['port'] . ';dbname=' . $cfg['dbname'] . ';charset=' . $cfg['charset'];

        $this->db = new PDO($dsn, $cfg['user'], $cfg['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}