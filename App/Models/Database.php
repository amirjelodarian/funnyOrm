<?php
namespace App\Models;

require_once "./vendor/autoload.php";
use App\Models\BaseModels\BaseDatabase;



class Database extends BaseDatabase {
    // if you want change db attr , fill __construct $config = []
    public function __construct($config = [])
    {
        parent::__construct($config);
    }
    // create a MODELa database
    // if you have many database
    // you must duplicate Database.php
}
?>