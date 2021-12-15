<?php

use App\Models\BaseModels\Route;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: 10px;
            padding: 10px;
            text-align: center;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <h1>My Form</h1>
    <?= $DB ?>
    <form method="POST" action="<?= Route::$url ?>b">
        <input name="username"  /><br />
        <select name="allUsername">
        <?php foreach($users as $user) : ?>
            <option style="font-size: 20px;"><?= $user["username"] ?></option>
        <?php endforeach; ?>
        </select>
        <input type="submit" />
    </form>
</body>
</html>