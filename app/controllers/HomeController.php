<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index');
    }

    public function notFound()
    {
        $this->view('home/404');
    }
}