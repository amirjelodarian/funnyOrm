<?php 
namespace App\Models\BaseModels;
class Route{
    public  $getRouteDo = [];
    public  $postRouteDo = [];
    public function __destruct()
    {
        
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                foreach($this->getRouteDo[0] as $route => $do){
                    if($this->getUrl() == $route){
                         $this->checkDoStringOrFunction($do);
                     }
                 }
            break;
            case "POST":
                foreach($this->postRouteDo[0] as $route => $do){
                    if($this->getUrl() == $route){
                         $this->checkDoStringOrFunction($do);
                     }
                 }
            break;
            default:
                echo "bad method";
            break;
            

        }
        
                
        
        
    }
    private function getUrl(){
        $url = $_SERVER["SCRIPT_NAME"];
        $lastUrl = str_replace('index.php','',$url);
        return str_replace($lastUrl,'',$_SERVER["REQUEST_URI"]);
    }
    private function checkDoStringOrFunction($do){
        switch(gettype($do)){
            case "string":
                $classAndMethod = explode("@",$do);
                $class = $classAndMethod[0];
                $method = $classAndMethod[1];
                return call_user_func("{$class}::{$method}");
                break;
            case "object":
                return $do();
                break;
        } 

    
    }
    public  function get($route,$do){
        $val = [$route => $do];
        array_push($this->getRouteDo,$val);
    }

    public  function post($route,$do){
        $val = [$route => $do];
        array_push($this->postRouteDo,$val);
    }
}
?>