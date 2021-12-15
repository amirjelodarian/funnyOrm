<?php
require_once "../vendor/autoload.php";
use App\Models\BaseModels\Route;
use App\Models\BaseModels\View;
use App\Models\User;
use App\Models\User2;

//create intance of route for run construct and destruct
$route = new Route();
?>




<?php 


// $user = new User2();
Route::get('user/{id}/comment/{comment}','UserController@index');
Route::post('user/{id}/comment/{comment}/b','UserController@submit');

Route::get('o/{oid}/c/{cid}','UserController@index2');
Route::post('o/{oid}/c/{cid}/b','UserController@submit2');

// $route->post('b',"UserController@submit");

// $route->get('createuser',function(){
//     $user = new User2();
//     View::view('myTest',["users" => $user->all(),"DB" => $user->db]);
// });



?>
