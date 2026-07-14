<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);

        require_once BASE_PATH . "app/views/$view.php";
    }
}