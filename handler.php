<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verification</title>
</head>
<body>
<?php 

// how to access the username and password passed in from the form
echo "user:". $_POST['user'] . "<br>";
echo "pwd:" . $_POST['pwd'] . "<br>";

session_start();

// Connect to database server
$link = mysqli_connect("localhost", "root", "") or die (mysqli_error($link));

// Select database
mysqli_select_db($link, "login") or die(mysqli_error($link));

// The SQL statement is built
$strSQL = "SELECT * FROM users";

$rs = mysqli_query($link, $strSQL);
	
// Loop the recordset $rs
// Each row will be made into an array ($row) using mysql_fetch_array
$_SESSION["login"] = "NO";

while($row = mysqli_fetch_array($rs)) {
	// Write the value of the column FirstName (which is now in the array $row)
    echo $row['username'] . "<br /> password:" . $row['password'] . "<br>";
    
    if ($_POST['user'] ==  $row['username'] and $_POST['pwd'] == $row['password'])
    {
        echo "Yes <br>";
        echo "<br><br> <a href='protected.php'>Link to protected file</a> <br><br>s";
        $_SESSION["login"] = "YES";
    }
}

//$_SESSION["login"] = "YES";

// Close the database connection
mysqli_close($link);

?>
</body>
</html>