<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'salt', 'email_phone', 'full_name', 'date_of_birth', 'log_bonus', 'last_crawl', 'logo_img_path'];

    public function resgister(){
        
    }
}