<?php
namespace App\Models;
use Config\Mysql\MySqlDatabase;


class User extends MySqlDatabase{


    protected $table = "users";


    public function users()
    {//SHOW COLUMNS FROM users
        return $this->select()->get();
        
    }
}
$user = new User();
