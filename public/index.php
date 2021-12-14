<?php
require_once "../vendor/autoload.php";
use App\Models\BaseModels\Route;
use App\Models\BaseModels\View;
use App\Models\User;
use App\Models\User2;
$route = new Route();
?>




<?php 
// $user = new User2();
$route->get('user/{id}/comment/{comment}','UserController@index');
// $route->post('b',"UserController@submit");

// $route->get('createuser',function(){
//     $user = new User2();
//     View::view('myTest',["users" => $user->all(),"DB" => $user->db]);
// });



?>
