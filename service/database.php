<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "guest_book";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error) {
    echo "database connection is broken";
    die("error!");
}

?>