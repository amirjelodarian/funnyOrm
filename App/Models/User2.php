<?php
namespace App\Models;
use Config\Sqlite\SqliteDatabase;

class User2 extends SqliteDatabase{
    protected $table = "users";
}
