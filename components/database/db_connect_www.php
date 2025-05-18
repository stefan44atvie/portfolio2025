<?php

$localhost = "localhost";
$username = "d043ba32";
$password = "VWApM2XNQRKoLRtGNdqE";
$dbname = "d043ba32";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
// } else {
//     echo "Successfully Connected";
}