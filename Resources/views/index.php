<?php
require_once "../../vendor/autoload.php";
use App\Models\User;
use App\Models\User2;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
            <p>
                
            <?php 
            $user = new User();
            $user2 = new User2();
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
                var_dump($user2->where('username','amir')->get());
            ?>
            
            
            </p>

</body>
</html>