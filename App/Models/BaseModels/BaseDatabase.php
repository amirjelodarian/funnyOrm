<?php

namespace App\Models\BaseModels;
require_once "./vendor/autoload.php";
use function App\Utilities\errors;

use Exception;
use \PDO;
use \PDOException;
use function App\Utilities\myTrim;


class BaseDatabase {
    private $db;
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $port;
    public $connection;
    private $customDBConfig;
    private $errorMessage; // true false
    public $getMessages;
    public $connectionStatus;
    public $errorSepreator = "<myErrorSeprator>";
    public $sql;
    public $tableName = '';


    public function __construct($config = []){
        // check const database 
        // if null set manual model vars
        if (!empty($config)){
            isset($config['DB']) ? $this->db = $config['DB'] : null;
            isset($config['DB_HOST']) ? $this->host = $config['DB_HOST'] : null;
            isset($config['DB_PORT']) ? $this->port = $config['DB_PORT'] : null ;
            isset($config['DB_NAME']) ? $this->dbname = $config['DB_NAME'] : null;
            isset($config['DB_CUSTOM_CONFIG']) ? $this->customDBConfig = $config['DB_CUSTOM_CONFIG'] : null;
            isset($config['DB_USERNAME']) ? $this->username = $config['DB_USERNAME'] : null;
            isset($config['DB_PASSWORD']) ? $this->password = $config['DB_PASSWORD'] : null;
            isset($config['DB_ERROR_MESSAGE']) ? $this->errorMessage = $config['DB_ERROR_MESSAGE'] : null;
        }else{
            DB !== '' ? $this->db = DB : null;
            DB_HOST !== '' ? $this->host =  DB_HOST : null;
            DB_PORT !== '' ? $this->port = DB_PORT : null;
            DB_NAME !== '' ? $this->dbname = DB_NAME : null;
            DB_CUSTOM_CONFIG !== '' ? $this->customDBConfig = DB_CUSTOM_CONFIG : null;
            DB_USERNAME !== '' ? $this->username = DB_USERNAME : null;
            DB_PASSWORD !== '' ? $this->password = DB_PASSWORD : null;
            DB_ERROR_MESSAGE !== '' ? $this->errorMessage = DB_ERROR_MESSAGE : null;
        }
        // open connection
        $this->openConnection();

        // fill table name
        $this->fillTableName();
        
    }

    // close connection after do everything
    public function __destruct()
    {
        return $this->closeConnection();   
    }

    private function fillTableName(){
        try{$this->tableName   =   $this->getTableName();  }
        catch(Exception $e)    {   $this->tableName = '';  }
    }

    protected function openConnection(){
        $this->connectionStatus = true;
        try{
            if(isset($this->username) && $this->username !== '' && isset($this->password) && $this->password !== '')
                $this->connection = new PDO($this->setDBAttr(),$this->username,$this->password);
            else
                $this->connection = new PDO($this->setDBAttr());
            if($this->errorMessage == true)
                $this->connection->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
          
                
        }
        catch(PDOException $e){
            $this->connectionStatus = false;
            if($this->errorMessage == true)
                $this->errorHandle($e->getMessage());
            $this->closeConnection();
        }
        if($this->connectionStatus == false)
            return false;
        else
            return true;
        
    }

    public function setDBAttr(){
        $DBAttr = "{$this->db}:";
        $counter = 0;
        if(isset($this->host) && $this->host !== ''){
            $DBAttr .= "host={$this->host};";
            $counter++;
        }
         
        if(isset($this->port) && $this->port !== ''){
            $DBAttr .= "port={$this->port};";
            $counter++;
        } 
        if(isset($this->customDBConfig) && $this->customDBConfig !== ''){
            $DBAttr .= "{$this->customDBConfig}";
            $counter++;
        }
        if($this->db == 'sqlite'){
            if(isset($this->dbname) && $this->dbname !== ''){
                $DBAttr .= "{$this->dbname};";
                $counter++;
            }
        }
        if($this->db == 'mysql'){
            if(isset($this->dbname) && $this->dbname !== ''){
                $DBAttr .= "dbname={$this->dbname};";
                $counter++;
            }
        }

        // this can search in config db , if config option is just 1 then delete ;   
        // otherwise don't delete
        if($counter == 1)
            return myTrim($DBAttr,';','');
        else
            return $DBAttr;
        
            
    }

    private function errorHandle($error){
        $this->getMessages .= $error . $this->errorSepreator;
        errors($this->getMessages);
    }
    
    //close connection
    public function closeConnection(){
        if(isset($this->connection))
            $this->connection = null;
    }

    //get all columns of table
    public function getTableColumns($table = ''){
        $resultTable = $this->chooseTable($table);
        switch ($this->db){
            case 'mysql':
                $this->sql = "SHOW COLUMNS FROM {$resultTable}";
                $allCols = [];
                for ($i = 0;$i < count($this->query()->fetchAll());$i++)
                    array_push($allCols,myTrim($this->query()->fetchAll()[$i]["Field"]));
                return $allCols;
                break;
            case 'sqlite':
                $this->sql = "SELECT sql FROM sqlite_master WHERE tbl_name = {$resultTable} AND type = 'table'";
                return $this->query()->fetchAll();
                break;
            default:
                echo "go to App/Models/BaseModels/BaseDatabase.php func getTableColumns add your db structure show Columns";
                break;
        }
    }

    private function chooseTable($table){
        if($table !== '')
            $resultTable = $table;
        elseif($this->tableName !== '')
            $resultTable = $this->tableName;
        else
            $resultTable = $this->getTableName();
        
        return $resultTable;
    }

    // get table name
    private function getTableName(){
        return get_class_vars(get_called_class())['table'];
    }

    public function table($table = ''){
        $this->tableName = $table;
        return $this;
    }

    // SELECT SQL
    public function select($columns = '*',$tableName = '',$customSql = '')
    {
        
        // this get find called class table name
        // $calledClassTableName = get_class_vars(get_called_class())['tableName']
        $tableName = $this->chooseTable($tableName);
        $this->sql = "SELECT {$columns} FROM {$tableName} {$customSql}";
        return $this;
    }

    public function sql($sql){
        $this->sql .= $sql;
        return $this;
    }

    // WHERE SQL
    public function where($column = '',$condition = '=',$value = ''){
        if($value == '' || empty($value) || !isset($value)){
            $lastValue = $condition;
            $lastCondition = '=';
            
        }else{
            $lastValue = $value;
            $lastCondition = $condition;
        }
        $this->sql .= " WHERE {$column} {$lastCondition} '{$lastValue}' ";
        return $this;
    }

    // LIMIT SQL
    public function limit($count){
        $this->sql .= " LIMIT {$count} ";
        return $this;

    }

    public function orderBy($column,$sortBy){
        $this->sql .= " ORDER BY {$column} {$sortBy} ";
        return $this;
    }

    public function find($value ,$value2 = '',$value3 = ''){
        switch($this){
            // use custom and where with custome condition (=,LIKE,>,<)
            case ($value !== '' && $value2 !== '' && $value3 !== ''):
                $column = $value;
                $condition = $value2;    
                $find = $value3;
                return $this->select()->where($column,$condition,$find)->get(); 
                break;

            // use custom and where with = condition
            case ($value !== '' && $value2 !== '' && $value3 == ''):
                $column = $value;
                $find = $value2;
                return $this->select()->where($column,$find)->get();
                break;

            // just find By Id
            case ($value !== '' && $value2 == '' && $value3 == ''):
                // $this->getTableColumns()[0] : zero index equal first columns or ID
                $colId = $this->getTableColumns()[0];
                return $this->select()->where($colId,$value)->get();
                break;
                
            default:
                echo "you fill wrong value in find() method";
                break;
        }
    }

    public function findById($id = 1){
        return $this->find($id);
    }

    public function findAll($limit = ''){
        if($limit !== '')
            return $this->select()->limit($limit)->get();
        else
            return $this->select()->get();
    }


    // prepare and execute SQL
    public function query($sql = '')
    {
        if (isset($sql) && !empty($sql))
            $resultSql = $sql;
        else
            $resultSql = $this->sql;

        $query = $this->connection->prepare($resultSql);
        $query->execute();
        return $query;
    }


    // fetchAll SQL
    public function get($count = '')
    {
        if (isset($count) && !empty($count))
            $this->limit($count);
        return $this->query()->fetchAll();
    }


}
?>