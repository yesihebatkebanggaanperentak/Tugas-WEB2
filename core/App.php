<?php

require_once BASE_PATH . 'app/controllers/HomeController.php';

class App
{
    public function __construct()
    {
        Router::route();
    }
}