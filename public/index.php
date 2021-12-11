<?php
require_once "../vendor/autoload.php";
use App\Models\BaseModels\Route;
use App\Models\BaseModels\View;
use App\Models\User2;
$route = new Route();
?>




<?php 

// $route->get('a',function(){
//  echo "eee";
// });
// $route->post('b',"UserController@submit");

// $route->get('createuser',function(){
//     $user = new User2();
//     View::view('myTest',["users" => $user->all(),"DB" => $user->db]);
// });
$str = "book/{bookid}/blog{blogid}";
function getStringsBetween($str,$with_from_to=true ,$start='{', $end='}'){
    $arr = [];
    $last_pos = 0;
    $last_pos = strpos($str, $start, $last_pos);
    while ($last_pos !== false) {
        $t = strpos($str, $end, $last_pos);
        $arr[] = ($with_from_to ? $start : '').substr($str, $last_pos + 1, $t - $last_pos - 1).($with_from_to ? $end : '');
        $last_pos = strpos($str, $start, $last_pos+1);
    }
    return $arr; 
}

echo getStringsBetween($str,false)[0];
?>
