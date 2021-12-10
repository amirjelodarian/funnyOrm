<?php

use App\Models\BaseModels\View;
use App\Models\User2;
use App\Models\User;
use function App\Utilities\view;
class UserController {
    public function index(){
        $user = new User2();
        View::view('myTest',["users" => $user->all(),"DB" => $user->db]);
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
            echo $user->getMessages;
        }
    }
}
?>