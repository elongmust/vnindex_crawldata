<?php

namespace App\Models;

use CodeIgniter\Model;

class ExchangeModel extends Model {

    protected $table = 'exchanges';
    // protected $primaryKey = 'name';
    protected $allowedFields = ['name'];

    public function getAllExchanges(){
        return $this->findAll();
    }


}