<?php
require_once "../vendor/autoload.php";
use App\Models\BaseModels\Route;
$route = new Route();

       
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
                $route->get('a',"UserController@index");
                $route->post('b',"UserController@submit");
            ?>
