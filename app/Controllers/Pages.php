<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function login(){
        // return view('login');
        echo view('templates/header');
        echo view('login');
        echo view('templates/footer');        
    }
}
