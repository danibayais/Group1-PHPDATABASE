<?php
// db.php: Establish a connection to the database

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoe_store";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    echo "";
}
?>
