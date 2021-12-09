<?php
namespace App\Models;

require_once "./vendor/autoload.php";
use App\Models\BaseModels\BaseDatabase;



class Database2 extends BaseDatabase {
    
    protected $table = 'users';
    // if you have any db change config vars
    private $config = [
        'DB' => 'sqlite',
        'DB_NAME' => 'App/Models/database.sqlite',
        'DB_ERROR_MESSAGE' => true
    ];

    public function __construct()
    {
        parent::__construct($this->config);
    }
    // create a MODEL database
    // if you have many database
    // you must duplicate Database.php
}

?>