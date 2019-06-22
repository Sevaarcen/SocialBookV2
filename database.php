<?php
$mysql_server = "localhost";
$mysql_username = "root";
$mysql_password = "CHANGEME";
$databasename = "SocialBook_DB";

// Create connection
$connection = mysqli_connect($mysql_server, $mysql_username, $mysql_password, $databasename);

// Check connection
if (!$connection) {
    die("Connection failed: " . $connection->connect_error);
}
?>
