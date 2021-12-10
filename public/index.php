<?php
require_once "../vendor/autoload.php";
use App\Models\BaseModels\Route;
$route = new Route();
?>




<?php 

$route->get('a',"UserController@index");
$route->post('b',"UserController@submit");

?>
