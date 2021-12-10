<?php
// mysql
defined('MYSQL_DB') ? null :
     define('MYSQL_DB','mysql');

defined('MYSQL_DB_HOST') ? null :
     define('MYSQL_DB_HOST','localhost');

defined('MYSQL_DB_PORT') ? null :
     define('MYSQL_DB_PORT','3306');

defined('MYSQL_DB_NAME') ? null :
     define('MYSQL_DB_NAME','dress');

defined('MYSQL_DB_USERNAME') ? null :
     define('MYSQL_DB_USERNAME','root');

defined('MYSQL_DB_PASSWORD') ? null :
     define('MYSQL_DB_PASSWORD','');

defined('MYSQL_DB_ERROR_MESSAGE') ? null :
     define('MYSQL_DB_ERROR_MESSAGE',true);

defined('MYSQL_DB_CUSTOM_CONFIG') ? null :
     define('MYSQL_DB_CUSTOM_CONFIG','charset=utf8;');


//sqlite
defined('SQLITE_DB') ? null :
     define('SQLITE_DB', 'sqlite');
defined('SQLITE_DB_NAME') ? null :
     define('SQLITE_DB_NAME', 'C:\xampp\htdocs\dashboard\funnyOrm\Config\Sqlite\database.sqlite');
defined('SQLITE_DB_ERROR_MESSAGE') ? null :
     define('SQLITE_DB_ERROR_MESSAGE', true);
?>