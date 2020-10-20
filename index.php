<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
        form {
            padding-left: 40px;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 10%;
        }
    </style>
</head>
<body>

    <img src="logo.png" alt="exeter logo">

    <form action="handler.php" method="post">
        <p>
        <div class="form-group">
            <label for="user">Username</label>
            <input type="text" class="form-control" id="user" name="user">
        </div>
        <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" id="pwd" name="pwd">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </p>
    </form>
</body>
</html>