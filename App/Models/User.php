<?php
namespace App\Models;
use Config\Mysql\MySqlDatabase;


class User extends MySqlDatabase{
    protected $table = "users";
}

