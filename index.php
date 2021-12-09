<?php

use App\Models\Database2;
use App\Models\User;
require_once "./vendor/autoload.php";

$user = new App\Models\User();
$db2 = new Database2();
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
                var_dump($db2->find(4));
            ?>
            
            
            </p>

</body>
</html>