<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "toko_online";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database_name);

// Check connection
if (mysqli_connect_errno()) {
     echo 'Failed to cnnect to MYSQL : ' . mysqli_connect_error();
     exit;
}
