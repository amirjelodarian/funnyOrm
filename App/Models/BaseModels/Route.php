<?php 
namespace App\Models\BaseModels;

use Exception;


class Route{
    public  $getRouteDo = [];
    public  $postRouteDo = [];
    public $request = [];
    public static $url;
    public function __construct()
    {
        self::$url = $this->url();
    }
    public function __destruct()
    {
        
        switch($_SERVER['REQUEST_METHOD']){
            case "GET":
                $this->handleUrl($this->getRouteDo,'GET');
                break;
            case "POST":
                $this->handleUrl($this->postRouteDo,'POST');
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
                        // convert to array ,
                        // entered url in router ,
                        // current url
                        $dividRoute = explode('/',$route);
                        $dividCurrentUrl = explode('/',$this->getUrl());
                        //////////////////////////
                        // check , if size not equal mean to bad url 
                        // and not match with together
                        if(count($dividRoute) == count($dividCurrentUrl)){
                            // this can fill $this->request by key => value
                            $this->fillQueryString($route,'GET');
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
                            if(count($status) == count($dividRoute))
                                $this->checkDoStringOrFunction($do);    
                            else
                                echo "Bad Routing ! Not Equal Url With Entered Url In Router !";
                        }else
                            echo "Error 404 ! Not Found";
                            // echo "You Increased Or Decrease Routing Args!";        
                        break;
                    case "POST":
                         // convert to array ,
                        // entered url in router ,
                        // current url
                        $dividRoute = explode('/',$route);
                        $dividCurrentUrl = explode('/',$this->getUrl());
                        //////////////////////////
                        // check , if size not equal mean to bad url 
                        // and not match with together
                            // this can fill $this->request by key => value
                            $this->fillQueryString($route,'POST');
                            
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
                            if(count($status) == count($dividRoute))
                                $this->checkDoStringOrFunction($do);    
                            else
                                echo "Bad Routing ! Not Equal Url With Entered Url In Router !";
                            // echo "You Increased Or Decrease Routing Args!"; 
                        break;
                    default:
                        echo "Handle Url Error In Router!";
                        break;
                }
                
            }
         }
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
    private function getUrl(){
        // can see user url entered
        // /project/public/hello world
        // hello world returned
        $url = $_SERVER["SCRIPT_NAME"];
        $lastUrl = str_replace('index.php','',$url);
        return str_replace($lastUrl,'',$_SERVER["REQUEST_URI"]);
    }

    public function url(){
        $mainRoute = str_replace('index.php','',$_SERVER["SCRIPT_NAME"]); 
        return  $mainRoute . $this->getUrl();
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