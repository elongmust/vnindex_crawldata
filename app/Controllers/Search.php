<?php

namespace App\Controllers;

use App\Models\UserModel;


class Search extends BaseController
{
    public function index(){

        return view('search/index');
    }
}