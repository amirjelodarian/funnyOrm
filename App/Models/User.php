<?php


namespace App\Models;

class User extends Database{


    protected $table = "users";


    public function users()
    {//SHOW COLUMNS FROM users
        return $this->select()->where('id',26)->get();
        
    }
}
$user = new User();