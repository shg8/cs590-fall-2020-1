<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <form action="handler.php" method="post">
        <p>
        Username <input type="text" name="username"> <br> <br>
        Password <input type="text" name="pwd"> <br> <br>
        <input type="submit" value="Log In!">
        </p>
    </form>
</body>
</html>