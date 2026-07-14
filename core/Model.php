<?php

require_once BASE_PATH . 'core/Database.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->pdo;
    }
}