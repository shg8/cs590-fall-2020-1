<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verification</title>
</head>
<body>
<?php 

function good()
{
    echo "<h1>You have successfully logged in </h1>";
    $_SESSION["login"] = "YES";
    
    
}  

function bad()
{
    echo "<h1>You have failed to login.</h1>";
    echo "<a href='index.php'>Go back to log in page</a> <br><br>";
}

session_start();

// Connect to database server
$link = mysqli_connect("localhost", "root", "") or die (mysqli_error($link));

// Select database
mysqli_select_db($link, "login") or die(mysqli_error($link));

// The SQL statement is built
$strSQL = "SELECT * FROM users";

$rs = mysqli_query($link, $strSQL);

$isIn = false;

if ($_SESSION["login"] == "YES")
{
    good();
}
else
{
    $_SESSION["login"] = "NO";

    while($row = mysqli_fetch_array($rs)) 
    {
        //echo $row['username'] . " " . $row['password'] . "<br>";
        if ($_POST['user'] == $row['username'] and $_POST['pwd'] == $row['password'])
        {
            $isIn = true;
            good();
        }
    }

    if (!$isIn)
    {
        bad();
    }
}


//$_SESSION["login"] = "YES";

// Close the database connection
mysqli_close($link);

?>
</body>
</html>