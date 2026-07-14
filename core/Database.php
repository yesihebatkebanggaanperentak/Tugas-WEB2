<?php

require_once BASE_PATH . "config/Database.php";

class Database
{
    private $host = Config::HOST;
    private $dbname = Config::DBNAME;
    private $user = Config::USER;
    private $pass = Config::PASS;

    public $pdo;

    public function __construct()
    {
        try {

            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e){

            die("Koneksi Database Gagal : " . $e->getMessage());

        }
    }
}