<?php 
namespace App\Models\BaseModels;

use Exception;


class Route{
    public static $getRouteDo = [];
    public  static $postRouteDo = [];
    public $request = [];
    public static $url;
    public static $home;

    public function __construct()
    {
        self::$url = self::url() . '/';
        self::$home = self::url('home');
    }
    
    public function __destruct()
    {
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                $this->handleUrl(self::$getRouteDo,'GET');
                break;
            case "POST":
                $this->handleUrl(self::$postRouteDo,'POST');
                break;
            default:
                echo "bad method";
                break;
            

        }   
    }

    private function handleUrl($values = [],$method){
        
        foreach($values as $routeDo){
            foreach($routeDo as $route => $do){
                // this can fill request attr user entered in url and router
                switch($method){
                    case "GET":
                            $this->dividedUrlAndCalculate($route,$do,'GET');
                        break;
                    case "POST":
                            $this->dividedUrlAndCalculate($route,$do,'POST');
                        break;
                    default:
                        echo "Handle Url Error In Router!";
                        break;
                }            
            }
         }
    }

    private function dividedUrlAndCalculate($route,$do,$method){
        // convert to array ,
        // entered url in router ,
        // current url
        $dividRoute = explode('/',$route);
        $dividCurrentUrl = explode('/',$this->getUrl());
        // check , if size not equal mean to bad url 
        // and not match with together
        if(count($dividRoute) == count($dividCurrentUrl)){
            // this can fill $this->request by key => value
            // delete {} bracets values and just keep real url
            // for example
            // user/{userid}/book/{bookid}
            // just keep user , book
            foreach($this->findGivenUrlNameArray($route) as $routeWithBracet){
                $index = array_search($routeWithBracet,$dividRoute);
                unset($dividRoute[$index]);
            }

            // check if $dividRoute belong to current client url
            $status = array_intersect($dividRoute,$dividCurrentUrl);
            if(count($status) == count($dividRoute)){
                $this->fillQueryString($route,$method);
                $this->checkDoStringOrFunction($do);   
            }
            ////////////////////////////////////////////////////
                 
        }else
            echo "Error 404 ! Not Found<br />";
            // echo "You Increased Or Decrease Routing Args!"; 
    }

    private function fillQueryString($routerUrl,$method){
        $dividRoute = explode('/',$routerUrl);
        $dividCurrentUrl = explode('/',$this->getUrl());
        for($i = 0; $i < count($dividCurrentUrl); $i++)
            if($dividCurrentUrl[$i] !== $dividRoute[$i])
                $this->request[$this->findGivenUrlName($dividRoute[$i])] = $dividCurrentUrl[$i]; 

        if($method == 'POST')
            foreach($_POST as $variable => $value)
                $this->request[$variable] = $value; 
        
        return $this;        
    }


    private function findGivenUrlName($url ,$start='{', $end='}'){
        $arr = "";
        $last_pos = 0;
        $last_pos = strpos($url, $start, $last_pos);
        while ($last_pos !== false) {
            $t = strpos($url, $end, $last_pos);
            $arr = substr($url, $last_pos + 1, $t - $last_pos - 1);
            $last_pos = strpos($url, $start, $last_pos+1);
        }
        return $arr; 
    }

    private function findGivenUrlNameArray($url, $withStartEnd = true,$start='{', $end='}'){
        $arr = [];
        $last_pos = 0;
        $last_pos = strpos($url, $start, $last_pos);
        while ($last_pos !== false) {
            $t = strpos($url, $end, $last_pos);
            array_push($arr,
                ($withStartEnd ? $start : '').substr($url, $last_pos + 1, $t - $last_pos - 1).($withStartEnd ? $end : ''));
            $last_pos = strpos($url, $start, $last_pos+1);
        }
        return $arr; 
    }

    private function checkDoStringOrFunction($do){
        switch(gettype($do)){
            case "string":
                    $classAndMethod = explode("@",$do);
                    $class = $classAndMethod[0];
                    $method = $classAndMethod[1];
                    return call_user_func("{$class}::{$method}",$this->request);    
                break;
            case "object":
                    return $do($this->request);
                break;
        } 

    
    }
    static public function get($route,$do){
        
        $val = [$route => $do];
        array_push(self::$getRouteDo,$val);
    }

    static public function post($route,$do){
        $val = [$route => $do];
        array_push(self::$postRouteDo,$val);
    }

    private function getUrl(){
        // can see user url entered
        // /project/public/hello world
        // hello world returned
        $url = $_SERVER["SCRIPT_NAME"];
        $lastUrl = str_replace('index.php','',$url);
        return str_replace($lastUrl,'',$_SERVER["REQUEST_URI"]);
    }

    public static function url($route = ''){
        switch($route){
            case "home":
                return str_replace('index.php','',$_SERVER["SCRIPT_NAME"]); 
                break;
            default:
                $mainRoute = str_replace('index.php','',$_SERVER["SCRIPT_NAME"]); 
                return  $mainRoute . self::getUrl();
                break;
        }
        
    }
}
?>