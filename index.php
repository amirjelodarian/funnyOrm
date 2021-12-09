<?php


use App\Models\User;
require_once "./vendor/autoload.php";

$user = new App\Models\User();

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
                var_dump($user->find(1));
            ?>
            
            
            </p>

</body>
</html>