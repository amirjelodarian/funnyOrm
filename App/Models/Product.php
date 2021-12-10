<?php
namespace App\Models;
use Config\Mysql\MySqlDatabase;

class Product extends MySqlDatabase{
    protected $table = "clothes";
    public function show()
    {
        return $this->tableName;
    }
}