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
        setTitle('Home Page');
        return view('home/index');
    }

    public function eror404(){
      useTemplate('blank_template');
      return view('404');
    }
}
