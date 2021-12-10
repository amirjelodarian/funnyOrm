<?php

namespace App\Models\BaseModels;

class View{
    private static $resourcePath = "../Resources/views/";
    private static function resultPath(){
        $path = dirname($_SERVER["SCRIPT_FILENAME"]).DIRECTORY_SEPARATOR.self::$resourcePath;
        return str_replace('/',DIRECTORY_SEPARATOR,$path);
    }
    
    public static function view($path,$data = []){
        
        if($data !== ''){
            foreach($data as $key => $value){
                ${$key} = $value;
            }
        }
        include(self::resultPath().$path.".php");
    }
}
?>