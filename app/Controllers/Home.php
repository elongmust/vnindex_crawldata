<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
   {
    
     $data                = array();
     $data['js']          = 'dashboards.js';
     $data['css']         = 'dashboards.css';
   }

    public function index()
    {
        // $data                = array();
        // $data['js']          = 'dashboards.js';
        // $data['css']         = 'dashboards.css';
        // $data['yield'] = 'welcome_message';
        // return view('default_template', $data);
        
        return view('index');
        
        echo view('layout/header', ['title' => 'Dash Board'])
            . view('index')
            . view('layout/footer');
    }
}
