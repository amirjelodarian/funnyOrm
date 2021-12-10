<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My Form</h1>
    <form method="POST" action="b">
        <input name="username"  /><br />
        <select>
        <?php foreach($users as $user) : ?>
            <option style="font-size: 20px;"><?= $user["username"] ?></option>
        <?php endforeach; ?>
        </select>
        <input type="submit" />
    </form>
</body>
</html>