<?php

use App\Models\BaseModels\View;
use App\Models\User2;
use function App\Utilities\view;
class UserController extends User2{
    public function index(){
        $user = new User2();
        View::view('myTest',["users" => $user->all()]);
    }
    public function submit(){
        $user = new User2();
        if(
            $user->update(["username" => $_POST["username"]])
            ->where('username',$_POST["allUsername"])
            ->get() !== false
        )
        {
            echo "updated ;) ";
        }else{
            echo "some error !";
        }
    }
}
?>