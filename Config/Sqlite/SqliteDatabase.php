<?php
namespace Config\Sqlite;
use App\Models\BaseModels\BaseDatabase;



class SqliteDatabase extends BaseDatabase {
    
    // if you have any db change config vars
    private $config = [
        'DB' => SQLITE_DB,
        'DB_NAME' => SQLITE_DB_NAME,
        'DB_ERROR_MESSAGE' => SQLITE_DB_ERROR_MESSAGE
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