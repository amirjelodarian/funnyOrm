<?php
namespace Config\Mysql;
use App\Models\BaseModels\BaseDatabase;



class MySqlDatabase extends BaseDatabase {
    private $config = [
        'DB' => MYSQL_DB ,
        'DB_HOST' => MYSQL_DB_HOST ,
        'DB_PORT' => MYSQL_DB_PORT ,
        'DB_NAME' => MYSQL_DB_NAME ,
        'DB_CUSTOM_CONFIG' => MYSQL_DB_CUSTOM_CONFIG ,
        'DB_USERNAME' => MYSQL_DB_USERNAME ,
        'DB_PASSWORD' => MYSQL_DB_PASSWORD ,
        'DB_ERROR_MESSAGE' => MYSQL_DB_ERROR_MESSAGE 
    ];
    // if you want change db attr , fill __construct $config = []
    public function __construct()
    {
        parent::__construct($this->config);
    }
    // create a MODELa database
    // if you have many database
    // you must duplicate Database.php
}
?>