<?php

use App\Models\BaseModels\Route;
use App\Models\BaseModels\View;
use App\Models\User2;
use App\Models\User;
use function App\Utilities\view;

class UserController {
    public function index($request){
        $user = new User();
        
           // var_dump($user->create([
                //     "user_mode" => "standard",
                //     "username" => "aslu",
                //     "password" => "asli",
                //     "tell" => '09303644573',
                //     "email" => "asddli@gmail.com",
                //     "address" => "asgar abad",
                //     "first_name" => "aslu",
                //     "last_name" => "sas",
                //     "create_at" => strftime('%Y-%m-%d %H:%M:%S',time()),
                //     "last_login" => strftime('%Y-%m-%d %H:%M:%S',time()),
                //     "pro_pic" => "sa54d5.jpg",
                //     "account_status" => "aslyy",
                // ]));
                // var_dump($user->users());
                // var_dump($user2->where('username','amir')->where('AND id',10)->get());
        
        view('myTest',["users" => $user->all(),"DB" => $user->db]);
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