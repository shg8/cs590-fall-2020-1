<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verification</title>
    <style>
        body {
            padding: 20px;
        }

        h3 {
            color: green;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>


<?php 

function good()
{
    echo "<h1>You have successfully logged in </h1>";
    $_SESSION['login'] = "YES";
    
    echo "<h3>Welcome " . $_SESSION['user'] . "</h3>";
}  

function bad()
{
    echo "<h1>You have failed to login.</h1>";
    echo "<a href='index.php'>Go back to log in page</a> <br><br>";
}

session_start();

if(isset($_POST['logbutton'])) { 
    $_SESSION['login'] = "NO";
    $_SESSION['user'] = "";
    $_SESSION['pwd'] = "";
    //session_destroy();
    header("Location: index.php");
}

if (isset($_POST['user']))
{
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['pwd'] = $_POST['pwd'];
    $_SESSION['login'] = "NO";
}

// Connect to database server
$link = mysqli_connect("localhost", "root", "") or die (mysqli_error($link));

// Select database
mysqli_select_db($link, 'login') or die(mysqli_error($link));

// The SQL statement is built
$strSQL = "SELECT * FROM users";

$rs = mysqli_query($link, $strSQL);

$isIn = false;

if ($_SESSION['login'] == "YES")
{
    good();
}
else
{
    $_SESSION['login'] = "NO";

    while($row = mysqli_fetch_array($rs)) 
    {
        //echo $row['username'] . " " . $row['password'] . "<br>";
        if ($_SESSION['user'] == $row['username'] and $_SESSION['pwd'] == $row['password'])
        {
            $isIn = true;
            //$_SESSION['user'] = $_POST['user'];
            //echo $_SESSION['user'] . "</br>";
            good();
        }
    }

    if (!$isIn)
    {
        bad();
    }
}


//$_SESSION['login'] = "YES";

// Close the database connection
mysqli_close($link);

?>
<br><br><br><br>

<form method="post"> 
    <button type="submit" class="btn btn-primary" name="logbutton">Log Out</button>
</form> 


</body>
</html>