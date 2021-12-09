<?php


namespace App\Models;


class Product extends Database
{
    protected $table = "clothes";
    public function show()
    {
        return $this->tableName;
    }
}
$product = new Product();