<?php

namespace App\Models;

use CodeIgniter\Model;

class IndexsModel extends Model {

    protected $table = 'stocks_indexs';
    // protected $primaryKey = 'name';
    protected $allowedFields = ['name', 'title'];

    public function getAllIndexs(){
        return $this->findAll();
    }


}